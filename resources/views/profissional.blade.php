@extends('layouts.app')

@section('title', $user->name . ' - Vila Contábil')

@section('content')
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-contents">
                    <h2 class="page-title">{{ $user->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="team-details-section pt-140 pb-140 pt-lg-100 pb-lg-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="team-details-card">
                    <div class="team-img mb-30">
                        @if($user->photo_url)
                            <img src="{{ asset('uploads/avatars/' . $user->photo_url) }}" alt="{{ $user->name }}" class="img-fluid rounded">
                        @else
                            <div class="default-avatar">
                                <i class="fa-solid fa-user"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="contact-info">
                        <h4 class="mb-20">Informações de Contato</h4>
                        
                        @if($user->phone)
                            <div class="contact-item mb-15">
                                <i class="fa-solid fa-phone"></i>
                                <span>{{ $user->phone }}</span>
                            </div>
                        @endif
                        
                        @if($user->whatsapp)
                            <div class="contact-item mb-15">
                                <i class="fa-brands fa-whatsapp"></i>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->whatsapp) }}" target="_blank">{{ $user->whatsapp }}</a>
                            </div>
                        @endif
                        
                        <div class="contact-item mb-15">
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                        </div>
                        
                        @if($user->city && $user->state)
                            <div class="contact-item mb-15">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                <span>{{ $user->city }}, {{ $user->state }}</span>
                            </div>
                        @endif
                        
                        @if($user->address)
                            <div class="contact-item mb-15">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ $user->address }}</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="social-links mt-30">
                        @if($user->facebook)
                            <a href="{{ $user->facebook }}" target="_blank" class="social-link">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        @endif
                        
                        @if($user->instagram)
                            <a href="{{ $user->instagram }}" target="_blank" class="social-link">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        @endif
                        
                        @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" target="_blank" class="social-link">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="team-details-content">
                    <h2 class="team-name mb-20">{{ $user->name }}</h2>
                    
                    @if($user->specialties && $user->specialties->count() > 0)
                        <div class="specialties mb-30">
                            <h5>Especialidades:</h5>
                            @foreach($user->specialties as $specialty)
                                <span class="badge bg-primary me-2 mb-2">{{ $specialty->name }}</span>
                            @endforeach
                        </div>
                    @endif
                    
                    @if($user->description)
                        <div class="description mb-40">
                            <h5>Sobre o Profissional</h5>
                            <p>{!! nl2br(e($user->description)) !!}</p>
                        </div>
                    @endif
                    
                    <div class="action-buttons">
                        @if($user->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->whatsapp) }}?text=Olá, encontrei seu contato na Vila Contábil e gostaria de conversar sobre serviços contábeis." 
                               target="_blank" 
                               class="btn btn-success me-3 mb-3">
                                <i class="fa-brands fa-whatsapp"></i> Conversar no WhatsApp
                            </a>
                        @endif
                        
                        <a href="mailto:{{ $user->email }}?subject=Contato via Vila Contábil" 
                           class="btn btn-primary me-3 mb-3">
                            <i class="fa-solid fa-envelope"></i> Enviar E-mail
                        </a>
                        
                        <a href="{{ route('profissionais') }}" class="btn btn-outline-secondary mb-3">
                            <i class="fa-solid fa-arrow-left"></i> Voltar aos Profissionais
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.team-details-card {
    background: #fff;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.team-img {
    text-align: center;
}

.team-img img {
    max-width: 200px;
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.default-avatar {
    width: 200px;
    height: 200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    border-radius: 10px;
    font-size: 4rem;
    color: #6c757d;
}

.contact-item {
    display: flex;
    align-items: center;
    gap: 10px;
}

.contact-item i {
    width: 20px;
    color: #0085fe;
}

.social-links {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
    color: #666;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: #0085fe;
    color: white;
}

.team-details-content {
    padding-left: 30px;
}

.team-name {
    color: #333;
    font-weight: 600;
}

.specialties .badge {
    font-size: 0.9rem;
    padding: 8px 12px;
}

.description {
    line-height: 1.6;
}
</style>
@endpush