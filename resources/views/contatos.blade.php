@extends('layouts.app')

@section('title', 'Contatos - Vila Contábil')

@section('content')
<div class="page-title-area">
                <div class="breadcrumb-wrapper background-image" style="background-image: url(&quot;./images/vila/bg-ultrawide-3.webp&quot;);">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h2 class="breadcrumb-title">Fale Conosco</h2>
                            <ul class="breadcumb-menu">
                                <li><a href="index.php">Início</a></li>
                                <li><a href="contatos.php">Contato</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <section class="contact-section position-relative z-2 pt-50 pb-80">
                <div class="container">
                    <div class="row justify-content-end">
                        <div class="col-xl-6 col-sm-12">
                            <img src="./images/vila/robo-cao-2 (1).png" class="w-100" alt="">
                        </div>
                        <div class="col-xl-6 col-sm-12">
                            <div class="col-xl-12 col-lg-12 mb-12">
                                <div class="info-box2 text-center p-4">
                                    <div class="icon mb-3">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <h3 class="info-title">Endereço</h3>
                                        <address>
                                            Rua Tatuibi, 507, Vila Paulista, Limeira, SP, CEP 13484-050
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mb-12">
                                <div class="info-box2 text-center p-4">
                                    <div class="icon mb-3">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <h3 class="info-title">E-mail</h3>
                                        <p>comercial@vilasoftware.com.br</p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 mb-12">
                                <div class="info-box2 text-center p-4">
                                    <div class="icon mb-3">
                                        <i class="bi bi-telephone-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <h3 class="info-title">Telefone</h3>
                                        <p><a href="tel:+5519982200364">(19) 98220-0364</a>
                                        </p><p>Atendimento: Seg–Sex 9:00–18:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="cta-section position-relative pt-70 pb-100 pt-lg-60 pb-lg-60">
                <img class="d-none d-lg-inline-block position-absolute start-0 mt-170 ml-140 top-0 rotation" src="assets/img/shape/shape-9.png" alt="shape">
                <img class="d-none d-lg-inline-block position-absolute end-0 mt-170 mr-100 top-0 rotation" src="assets/img/shape/shape-9.png" alt="shape">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="title-one text-center">
                                <h2 class="title">Precisa de ajuda imediata?</h2>
                                <p class="mb-3">Clique no botão abaixo para falar com nosso time via WhatsApp.</p>
                                <a href="https://wa.me/5511999999999" target="_blank" rel="noopener"  target="_blank" class="ht-btn mt-25">Fale pelo WhatsApp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection

@push('styles')
<style>
.contact-form-wrapper {
    background: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.contact-info-wrapper {
    padding-left: 30px;
}

.contact-info-card {
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    text-align: center;
}

.contact-info-card .icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #0085fe;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 1.5rem;
}

.contact-info-card h4 {
    color: #333;
    margin: 15px 0 10px;
    font-weight: 600;
}

.contact-info-card p {
    color: #666;
    margin: 0;
}

.contact-info-card a {
    color: #0085fe;
    text-decoration: none;
}

.contact-info-card a:hover {
    text-decoration: underline;
}

.form-control {
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    padding: 12px 15px;
    height: auto;
}

.form-control:focus {
    border-color: #0085fe;
    box-shadow: 0 0 0 0.2rem rgba(0, 133, 254, 0.25);
}
</style>
@endpush