<!-- header-area start -->
<header class="theme-main-menu theme-menu-six">
    <div class="header-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="topbar-content d-flex align-items-center justify-content-center">
                        <div class="ht-topbar-left">
                            @auth
                                <span class="ht-promo d-none d-md-inline-block">
                                    Olá! Seja bem-vindo, {{ Auth::user()->name }}!
                                </span>
                            @else
                                <a href="#" class="ht-promo d-none d-md-inline-block" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Olá! Faça login / Cadastro
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-header-area">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-auto col-6">
                    <div class="logo-area">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/vila/logo_v3.png') }}" alt="Header-logo" width="120px">
                        </a>
                    </div>
                </div>

                <div class="col-md-auto d-flex align-items-center justify-content-end d-lg-inline-block d-none">
                    <div class="main-menu d-none d-lg-block">
                        <nav id="mobile-menu">
                            <ul class="menu-list">
                                <li><a href="{{ route('home') }}">Início</a></li>
                                <li><a href="{{ route('sobre-nos') }}">Sobre Nós</a></li>
                                <li><a href="{{ route('profissionais') }}">Vila-Class</a></li>
                                <li><a href="{{ route('contatos') }}">Contatos</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

                <div class="col-md-auto col-6">
                    <div class="right-nav d-flex align-items-center justify-content-end">
                        @auth
                            <div class="quote-btn d-flex align-items-center justify-content-center">
                                <a href="{{ route('painel') }}" class="me-2">
                                    <img src="{{ Auth::user()->photo_url
                                        ? \Illuminate\Support\Facades\Storage::url(Auth::user()->photo_url)
                                        : asset('images/default-user.png') }}"
                                         alt="Foto de perfil"
                                         style="width:60px; height:60px; object-fit:cover; border-radius:50%;">
                                </a>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="ht-btn bs-btn" style="border: none; background:#0085fe;">Sair</button>
                                </form>
                            </div>
                        @else
                            <div class="quote-btn d-none d-sm-flex">
                                <a href="#" class="ht-btn bstyle" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                            </div>
                        @endauth

                        <!-- Mobile Menu -->
                        <div class="mobile-nav-toggler mobile-nav-toggler-2 d-lg-none">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area end -->

<!-- Modal de Login/Registro -->
@guest
    @include('layouts.partials.login-modal')
@endguest