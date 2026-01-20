@extends('layouts.app')

@section('title', 'Cadastro - Vila Contábil')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h2 class="page-title">Cadastro</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="auth-section pt-140 pb-140 pt-lg-100 pb-lg-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="auth-form-wrapper">
                    <div class="text-center mb-40">
                        <h2 class="auth-title">Junte-se à Nossa Rede</h2>
                        <p class="auth-subtitle">Cadastre-se como profissional e conecte-se com clientes</p>
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
                    
                    <form action="{{ route('registration') }}" method="POST" class="auth-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-20">
                                    <label for="name" class="form-label">Nome Completo *</label>
                                    <input type="text" 
                                           id="name" 
                                           name="name" 
                                           class="form-control" 
                                           value="{{ old('name') }}" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="email" class="form-label">E-mail *</label>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           class="form-control" 
                                           value="{{ old('email') }}" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone" 
                                           class="form-control" 
                                           value="{{ old('phone') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="whatsapp" class="form-label">WhatsApp</label>
                                    <input type="tel" 
                                           id="whatsapp" 
                                           name="whatsapp" 
                                           class="form-control" 
                                           value="{{ old('whatsapp') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="cep" class="form-label">CEP</label>
                                    <input type="text" 
                                           id="cep" 
                                           name="cep" 
                                           class="form-control" 
                                           value="{{ old('cep') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="city" class="form-label">Cidade</label>
                                    <input type="text" 
                                           id="city" 
                                           name="city" 
                                           class="form-control" 
                                           value="{{ old('city') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="state" class="form-label">Estado</label>
                                    <input type="text" 
                                           id="state" 
                                           name="state" 
                                           class="form-control" 
                                           value="{{ old('state') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group mb-20">
                                    <label for="address" class="form-label">Endereço</label>
                                    <input type="text" 
                                           id="address" 
                                           name="address" 
                                           class="form-control" 
                                           value="{{ old('address') }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group mb-20">
                                    <label for="description" class="form-label">Descrição Profissional</label>
                                    <textarea id="description" 
                                              name="description" 
                                              class="form-control" 
                                              rows="4" 
                                              placeholder="Conte um pouco sobre sua experiência e especialidades...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="password" class="form-label">Senha *</label>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-control" 
                                           required>
                                    <small class="form-text text-muted">Mínimo 6 caracteres</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group mb-20">
                                    <label for="password_confirmation" class="form-label">Confirmar Senha *</label>
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-control" 
                                           required>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check mb-20">
                                    <input type="checkbox" 
                                           class="form-check-input" 
                                           id="terms" 
                                           name="terms" 
                                           required>
                                    <label class="form-check-label" for="terms">
                                        Concordo com os <a href="#" class="auth-link">Termos de Uso</a> e 
                                        <a href="#" class="auth-link">Política de Privacidade</a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 mb-20">
                                    <i class="fa-solid fa-user-plus"></i> Criar Conta
                                </button>
                            </div>
                            
                            <div class="col-12">
                                <div class="text-center">
                                    <p class="mb-0">
                                        Já tem uma conta? 
                                        <a href="{{ route('login') }}" class="auth-link">Faça login</a>
                                    </p>
                                </div>
                            </div>
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

textarea.form-control {
    height: auto;
    resize: vertical;
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

.form-text {
    font-size: 0.875rem;
}
</style>
@endpush