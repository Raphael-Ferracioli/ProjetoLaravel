<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Preencha todos os campos'
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return response()->json([
                'success' => true,
                'redirect' => route('painel')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'E-mail ou senha incorretos'
        ], 401);
    }

    public function showRegistration()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','min:6','confirmed'],

            // campos do modal de perfil
            'phone' => ['required','string','max:50'],
            'whatsapp' => ['required','string','max:50'],
            'cep' => ['required','string','max:20'],
            'state' => ['required','string','max:2'],
            'city' => ['required','string','max:255'],
            'address' => ['required','string','max:255'],
            'description' => ['required','string','max:2000'],

            // IMPORTANTÍSSIMO: o name é specialties[] no HTML,
            // mas no Laravel você valida como "specialties"
            'specialties' => ['required','array','min:1'],
            'specialties.*' => ['integer','exists:specialties,id'],

            'terms' => ['required'], // se você manda terms=1
        ]);

        $user = null;

        DB::transaction(function () use (&$user, $validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),

                'phone' => $validated['phone'],
                'whatsapp' => $validated['whatsapp'],
                'cep' => $validated['cep'],
                'state' => $validated['state'],
                'city' => $validated['city'],
                'address' => $validated['address'],
                'description' => $validated['description'],

                'profile_completed' => 1,
                // 'is_active' => 1, // se você quiser ativar automaticamente
            ]);

            
            $user->specialties()->sync($validated['specialties']);
        });

        Auth::login($user);

        return response()->json([
            'success' => true,
            'redirect' => route('painel'), // ou '/painel'
            'message' => 'Cadastro concluído com sucesso.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /*
    |--------------------------------------------------------------------------
    | ESQUECI A SENHA (BREVO)
    |--------------------------------------------------------------------------
    */

    // POST /forgot-password (AJAX)
public function forgotPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? response()->json(['success' => true, 'message' => 'Email enviado com sucesso!'])
        : response()->json(['success' => false, 'message' => 'Erro ao enviar email'], 500);
}

    // GET /reset-password/{token}
    public function showResetPassword(string $token, Request $request)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    // POST /reset-password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        [$table, $emailColumn, $tokenColumn, $createdAtColumn] = $this->passwordResetTableInfo();

        $row = DB::table($table)->where($emailColumn, $request->email)->first();

        if (!$row) {
            return back()->withErrors(['email' => 'Token inválido ou expirado.']);
        }

        $createdAt = Carbon::parse($row->{$createdAtColumn});
        if (now()->diffInMinutes($createdAt) > 60) {
            return back()->withErrors(['email' => 'Token expirado. Solicite novamente.']);
        }

        if (!Hash::check($request->token, $row->{$tokenColumn})) {
            return back()->withErrors(['email' => 'Token inválido.']);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table($table)->where($emailColumn, $request->email)->delete();

        return redirect()->route('home')->with('success', 'Senha alterada! Faça login.');
    }

    /**
     * Detecta se o projeto usa password_reset_tokens (Laravel mais novo)
     * ou password_resets (mais comum).
     */
    private function passwordResetTableInfo(): array
    {
        if (Schema::hasTable('password_reset_tokens')) {
            // Laravel 10/11
            return ['password_reset_tokens', 'email', 'token', 'created_at'];
        }

        // Laravel 8/9 e vários projetos
        return ['password_resets', 'email', 'token', 'created_at'];
    }

    /**
     * Envia e-mail via Brevo API.
     * Requer: config('services.brevo.key') e sender configurado.
     */
   private function sendBrevoResetEmail(string $toEmail, string $toName, string $resetUrl): void
    {
    $apiKey = env('BREVO_API_KEY');
    $senderEmail = env('BREVO_SENDER_EMAIL');
    $senderName  = env('BREVO_SENDER_NAME', 'Vila Contábil');

    if (!$apiKey || !$senderEmail) {
        throw new \Exception('BREVO_API_KEY ou BREVO_SENDER_EMAIL não configurados no .env');
    }

    $html = "
        <p>Olá, {$toName}.</p>
        <p>Para redefinir sua senha, clique no link abaixo:</p>
        <p><a href='{$resetUrl}'>{$resetUrl}</a></p>
        <p>Se você não solicitou, ignore este e-mail.</p>
    ";

    $payload = [
        'sender' => [
            'name'  => $senderName,
            'email' => $senderEmail,
        ],
        'to' => [
            ['email' => $toEmail, 'name' => $toName]
        ],
        'subject' => 'Recuperação de senha',
        'htmlContent' => $html,
    ];

    $res = Http::withHeaders([
        'accept' => 'application/json',
        'api-key' => $apiKey,
        'content-type' => 'application/json',
    ])->post('https://api.brevo.com/v3/smtp/email', $payload);

    if (!$res->successful()) {
        // Isso te mostra exatamente o erro da Brevo no log
        \Log::error('Brevo response', [
            'status' => $res->status(),
            'body'   => $res->body(),
        ]);

        throw new \Exception('Brevo falhou: ' . $res->status());
    }
}

}
