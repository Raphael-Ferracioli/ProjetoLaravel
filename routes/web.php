<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// VERIFICAÇÃO DE E-MAIL (PÚBLICO)
Route::post('/email/verify/send', [AuthController::class, 'sendVerifyCode'])
  ->name('email.verify.send');

Route::post('/email/verify/confirm', [AuthController::class, 'confirmVerifyCode'])
  ->name('email.verify.confirm');

// Páginas institucionais
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre-nos', [HomeController::class, 'sobreNos'])->name('sobre-nos');
Route::get('/contatos', [HomeController::class, 'contatos'])->name('contatos');

// Profissionais (público)
Route::get('/profissionais', [HomeController::class, 'profissionais'])->name('profissionais');
Route::get('/profissional/{id}', [HomeController::class, 'profissional'])->name('profissional');

Route::get('/search-professionals', [HomeController::class, 'searchProfessionals'])
  ->name('search.professionals');

// AJAX cidades por estado — público
Route::get('/ajax/cities', [HomeController::class, 'ajaxCities'])
  ->name('ajax.cities');


/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// Se você usa modal, essas páginas GET podem até existir, mas mantenha:
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/registration', [AuthController::class, 'showRegistration'])->name('registration');
Route::post('/registration', [AuthController::class, 'register'])->name('registration.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ESQUECI A SENHA (PÚBLICO)
|--------------------------------------------------------------------------
*/

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.forgot');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');


/*
|--------------------------------------------------------------------------
| ÁREA DO USUÁRIO (APENAS LOGADO)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

  Route::get('/painel', [UserController::class, 'painel'])->name('painel');

  // Status/ativação
  Route::post('/painel/account/status', [HomeController::class, 'setAccountStatus'])
    ->name('account.setStatus');

  Route::post('/toggle-account-status', [UserController::class, 'toggleAccountStatus'])
    ->name('toggle.account.status');

  // Perfil
  Route::post('/profile/complete', [UserController::class, 'completeProfile'])
    ->name('profile.complete');

  Route::post('/profile/update-field', [UserController::class, 'updateField'])
    ->name('profile.updateField');

  Route::post('/update-profile', [UserController::class, 'updateProfile'])
    ->name('update.profile');

  // Avatar (apenas UMA rota + UM name)
  Route::post('/upload-avatar', [UserController::class, 'uploadAvatar'])
    ->name('upload.avatar');
});
