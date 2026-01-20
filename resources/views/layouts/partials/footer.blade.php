<!--footer-area start-->
<footer class="footer-one pt-130">
    <div class="container">
        <div class="row mb-30">
            <div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="footer-widget ht-about-widget mb-30">
                    <div class="footer-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/vila/logo_v3.png') }}" style="width: 120px;" alt="logo">
                        </a>
                    </div>
                    <p class="mt-30 mb-30">Seu amigo digital para uma gestão completa, objetiva e prática para sua empresa contábil.</p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="footer-widget ms-xxl-5 mb-30">
                    <h4 class="widget-title">Navegue</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Início</a></li>
                        <li><a href="{{ route('sobre-nos') }}">Sobre Nós</a></li>
                        <li><a href="{{ route('profissionais') }}">Profissionais</a></li>
                        <li><a href="{{ route('contatos') }}">Contatos</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xxl-4 col-lg-4 col-md-12 col-sm-12">
                <div class="footer-widget mb-30">
                    <h4 class="widget-title">Contatos</h4>
                    <ul>
                        <li><a href="mailto:comercial@vilasoftware.com.br">comercial@vilasoftware.com.br</a></li>
                        <li><a href="tel:+5519982200364">(19) 98220-0364</a></li>
                        <li><a href="#">Rua Tatuibi, 507, Vila Paulista, Limeira, SP, CEP 13484-050</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright-wrap pb-xl-0 pb-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright-text text-lg-start text-center pt-40 pb-lg-5 pb-4">
                        © Copyright {{ date('Y') }} <a href="{{ route('home') }}">Vila Contábil</a>
                    </div>
                </div>
                <div class="col-md-6 text-xl-end text-center">
                    <ul class="footer-menu">
                        <li><a href="#">Termos e Condições</a></li>
                        <li><a href="#">Políticas de Privacidade</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer-area end-->