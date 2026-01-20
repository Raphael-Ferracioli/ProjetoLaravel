<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
public function setAccountStatus(Request $request)
{
    $data = $request->validate([
        'is_active' => ['required', 'boolean'],
    ]);

    $user = $request->user();

    // (Opcional, mas recomendado) Só permite ativar se o perfil estiver completo
    // Se você tiver essa coluna:
    if ((int)$data['is_active'] === 1 && (int)$user->profile_completed !== 1) {
        return response()->json([
            'success' => false,
            'message' => 'Complete seu perfil antes de ativar sua conta.'
        ], 422);
    }

    $user->is_active = (int) $data['is_active'];
    $user->save();

    return response()->json([
        'success'   => true,
        'is_active' => (int) $user->is_active,
    ]);
}

public function profissionais(Request $request)
{
    $name      = trim((string) $request->query('name', ''));
    $specialty = (int) $request->query('specialty', 0);
    $state     = strtoupper(trim((string) $request->query('state', ''))); // <- estado do filtro
    $city      = trim((string) $request->query('city', ''));

    // Lista fixa de UFs para o select
    $ufs = [
        'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo','GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
        'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RJ'=>'Rio de Janeiro','RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','RR'=>'Roraima','SC'=>'Santa Catarina','SP'=>'São Paulo','SE'=>'Sergipe','TO'=>'Tocantins'
    ];

    $q = User::query()
        ->where('is_active', 1)
        ->with('specialties');

    if ($name !== '') {
        $q->where('name', 'like', "%{$name}%");
    }

    if ($specialty > 0) {
        $q->whereHas('specialties', function ($sub) use ($specialty) {
            $sub->where('specialties.id', $specialty);
        });
    }

    // aplica filtro de estado corretamente
    if ($state !== '' && array_key_exists($state, $ufs)) {
        $q->where('state', $state);
    }

    if ($city !== '') {
        $q->where('city', $city);
    }

    $profissionais = $q->orderBy('name', 'asc')->get();

    $specialties = DB::table('specialties')
        ->select('id', 'name')
        ->where('is_active', 1)
        ->orderBy('name', 'asc')
        ->get();

    // agora você manda $ufs para a view (em vez de $states)
    return view('profissionais', compact('profissionais', 'specialties', 'ufs'));
}

    // PERFIL PÚBLICO DO PROFISSIONAL
    public function profissional($id)
    {
        $user = User::with('specialties')
            ->where('is_active', 1)
            ->findOrFail($id);

        return view('profissional', compact('user'));
    }

    // AJAX: cidades por estado (substitui get_cities.php)
    public function ajaxCities(Request $request)
    {
        $state = trim((string) $request->query('state', ''));

        if ($state === '') {
            return response()->json([]);
        }

        $cities = DB::table('users')
            ->where('is_active', 1)
            ->where('state', $state)
            ->whereNotNull('city')
            ->where('city', '<>', '')
            ->distinct()
            ->orderBy('city', 'asc')
            ->pluck('city');

        return response()->json($cities);
    }

    // Se você ainda quiser manter o POST antigo, deixa, mas agora sua página usa GET.
    public function searchProfessionals(Request $request)
    {
        // Mantido por compatibilidade (opcional).
        // Recomendo usar /profissionais GET (como no PHP antigo).
        return redirect()->route('profissionais', $request->only(['name','specialty','state','city']));
    }

    public function sobreNos()
    {
        return view('sobre-nos');
    }

    public function contatos()
    {
        return view('contatos');
    }
}
