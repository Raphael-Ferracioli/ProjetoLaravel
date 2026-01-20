<?php

namespace App\Http\Controllers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Specialty;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateField(Request $request)
    {
        $user = Auth::user();
        $field = $request->input('field');

        if (!in_array($field, ['name','description','phone','whatsapp','facebook','instagram','linkedin','location','specialties'])) {
            return response()->json(['success' => false, 'message' => 'Campo inválido.'], 422);
        }

        if ($field === 'location') {
            $data = $request->validate([
                'cep' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:100',
                'state' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            ]);

            $user->update($data);
            return response()->json(['success' => true]);
        }

        if ($field === 'specialties') {
            $data = $request->validate([
                'specialties' => 'required|array|min:1',
                'specialties.*' => 'integer|exists:specialties,id'
            ]);

            $user->specialties()->sync($data['specialties']);
            return response()->json(['success' => true]);
        }
        if (in_array($field, ['facebook','instagram','linkedin'])) {
            $data = $request->validate([
                'value' => 'nullable|url|max:255',
            ]);

            $user->update([$field => $data['value'] ?? null]);
            return response()->json(['success' => true]);
        }
        // campos simples
        $data = $request->validate([
            'value' => $field === 'name' ? 'required|string|max:255' : 'nullable|string',
        ]);

        $user->update([$field => $data['value'] ?? null]);

        return response()->json(['success' => true]);
    }

    public function painel()
    {
        $user = Auth::user()->load('specialties');

        $specialties = Specialty::where('is_active', 1)
            ->orderBy('name')
            ->get();

        return view('painel', compact('user', 'specialties'));
    }

public function completeProfile(Request $request)
{
    try {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'phone'       => 'required|string',
            'whatsapp'    => 'required|string',
            'cep'         => 'required|string',
            'city'        => 'required|string',
            'state'       => 'required|string',
            'address'     => 'required|string',
            'specialties' => 'required|array|min:1',
        ]);

        $user = Auth::user();

        $user->update([
            'name'              => $request->name,
            'description'       => $request->description,
            'phone'             => $request->phone,
            'whatsapp'          => $request->whatsapp,
            'cep'               => $request->cep,
            'city'              => $request->city,
            'state'             => $request->state,
            'address'           => $request->address,
            'profile_completed' => true,
        ]);

        $user->specialties()->sync($request->specialties);

        return response()->json([
            'success' => true,
            'message' => 'Perfil completo com sucesso!'
        ]);

    } catch (ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => $e->errors()
        ], 422);

    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'Erro interno ao salvar perfil'
        ], 500);
    }
}

    public function saveProfile(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'phone' => 'required|string',
            'whatsapp' => 'required|string',
            'cep' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'address' => 'required|string',
            'specialties' => 'required|array|min:1',
        ]);

        $user = Auth::user();

        $user->update([
            'description' => $request->description,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'cep' => $request->cep,
            'city' => $request->city,
            'state' => $request->state,
            'address' => $request->address,
            'profile_completed' => true,
        ]);

        // Sincroniza as especialidades com o banco
        $user->specialties()->sync($request->specialties);

        return redirect()->route('painel')->with('success', 'Perfil atualizado com sucesso!');
    }

    // Função para atualização do perfil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'required|in:AC,AL,AP,AM,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR,PE,PI,RJ,RN,RS,RO,RR,SC,SP,SE,TO',
            'cep' => 'nullable|string|max:10',
        ]);

        try {
            $user->update($request->only([
                'name', 'email', 'phone', 'whatsapp', 'facebook', 
                'instagram', 'linkedin', 'description', 'address', 
                'city', 'state', 'cep'
            ]));

            return response()->json([
                'success' => true,
                'message' => 'Perfil atualizado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar perfil.'
            ]);
        }
    }



public function uploadAvatar(Request $request)
{
    $request->validate([
        'avatar' => ['required', 'image', 'max:2048'],
    ]);

    $user = auth()->user();

    // opcional: apagar foto anterior (se estiver no mesmo disk/pasta)
    if ($user->photo_url) {
        Storage::disk('public')->delete($user->photo_url);
    }

    // salva em storage/app/public/avatars
    $path = $request->file('avatar')->store('avatars', 'public'); // ex: avatars/arquivo.jpg

    $user->photo_url = $path; // salva SOMENTE "avatars/arquivo.jpg"
    $user->save();

    return response()->json([
        'success'   => true,
        'photo_url' => Storage::url($path), // retorna "/storage/avatars/arquivo.jpg"
    ]);
}

    // Função para alterar o status da conta (ativa/inativa)
    public function toggleAccountStatus(Request $request)
    {
        try {
            $user = Auth::user();
            $user->update([
                'is_active' => !$user->is_active
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status da conta alterado com sucesso!',
                'is_active' => $user->is_active
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao alterar status da conta.'
            ]);
        }
    }
}
