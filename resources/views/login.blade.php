@extends('layouts.app')

@section('title', 'Login - Vila Contábil')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h2 class="page-title">Entrar</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="auth-section pt-140 pb-140 pt-lg-100 pb-lg-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-form-wrapper">
                    <div class="text-center mb-40">
                        <h2 class="auth-title">Bem-vindo de Volta!</h2>
                        <p class="auth-subtitle">Entre com suas credenciais para acessar sua conta</p>
                    </div>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('login') }}" method="POST" class="auth-form">
                        @csrf
                        <div class="form-group mb-20">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="{{ old('email') }}" 
                                   required>
                        </div>
                        
                        <div class="form-group mb-20">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   required>
                        </div>
                        
                        <div class="form-check mb-20">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="remember" 
                                   name="remember">
                            <label class="form-check-label" for="remember">
                                Lembrar de mim
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-20">
                            <i class="fa-solid fa-sign-in-alt"></i> Entrar
                        </button>
                        
                        <div class="text-center">
                            <p class="mb-0">
                                Não tem uma conta? 
                                <a href="{{ route('registration') }}" class="auth-link">Cadastre-se</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.auth-section {
    background: #f8f9fa;
}

.auth-form-wrapper {
    background: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.auth-title {
    color: #333;
    font-weight: 600;
    margin-bottom: 10px;
}

.auth-subtitle {
    color: #666;
    margin-bottom: 30px;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.form-control {
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    padding: 12px 15px;
    height: 50px;
    font-size: 16px;
}

.form-control:focus {
    border-color: #0085fe;
    box-shadow: 0 0 0 0.2rem rgba(0, 133, 254, 0.25);
}

.btn-primary {
    height: 50px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 5px;
}

.auth-link {
    color: #0085fe;
    text-decoration: none;
    font-weight: 600;
}

.auth-link:hover {
    text-decoration: underline;
}

.alert {
    border-radius: 5px;
    margin-bottom: 20px;
}
</style>
@endpush