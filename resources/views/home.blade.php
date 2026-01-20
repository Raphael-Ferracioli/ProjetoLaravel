@extends('layouts.app')

@section('title', 'Vila Contábil - Seu amigo digital para gestão de sua empresa contábil')

@section('content')
<section class="theme-banner-one">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h1 class="main-title">Seu amigo digital para gestão de sua empresa contábil de forma mais simples, humana e confiável</h1>
                <p class="hero-description pe-xxl-4">Nosso sistema Vila Contábil é uma ferramenta idealizada de empresário contábil para outro empresário contábil, onde somente com vivência na área sabe as ferramentas utilizadas para gestão de uma empresa contábil, e a importância de juntar todas em uma única ferramenta.</p>

                <div class="d-md-flex align-items-center mb-lg-0 mb-5">
                    <a href="{{ route('sobre-nos') }}" class="ht-btn bstyle me-xl-3">Conheça nosso objetivo</a>
                    <a href="#video" class="ht-btn bstyle-2 d-none d-xl-inline-block">Assista ao vídeo
                        <span class="popup-video ms-md-5 ms-3"><i class="bi bi-play-fill"></i></span></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="hero-img text-lg-end">
                    <img class="w-100" src="{{ asset('images/vila/hero-image.webp') }}" alt="Hero">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-section pt-140 pb-30 pt-lg-60 pb-lg-15">
    <div class="container">
        <div class="title-one text-center mb-75">
            <h2 class="title text-heding2 wow fadeInUp">Tudo o que você precisa em um só lugar.</h2>
            <p class="hero-description pe-xxl-4">Mais que um software, a Vila Contábil é um ecossistema de gestão de empresa contábil que simplifica, centraliza, organiza e conecta o empresário contábil com seus clientes.</p>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <div class="img-wrapper-one position-relative mb-45 wow fadeInLeft">
                    <img class="main-img img-fluid" src="{{ asset('images/solutions.png') }}" alt="About">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ps-xxl-5">
                    <div class="feature-wrap-1">
                        <div class="icon">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </div>
                        <div class="content">
                            <h4 class="feature-title"><a href="{{ route('sobre-nos') }}">Gestão de Tarefas</a></h4>
                            <p class="description">Automatize rotinas, acompanhe prazos e nunca mais perca uma obrigação.</p>
                        </div>
                    </div>
                    <div class="feature-wrap-1">
                        <div class="icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="content">
                            <h4 class="feature-title"><a href="{{ route('sobre-nos') }}">Colaboração Simplificada</a></h4>
                            <p class="description">Comunicação direta com clientes e equipes em um só canal.</p>
                        </div>
                    </div>
                    <div class="feature-wrap-1">
                        <div class="icon">
                            <i class="bi bi-wallet"></i>
                        </div>
                        <div class="content">
                            <h4 class="feature-title"><a href="{{ route('sobre-nos') }}">Controle de Obrigações</a></h4>
                            <p class="description">Evite atrasos, multas e falhas de compliance.</p>
                        </div>
                    </div>
                    <div class="feature-wrap-1">
                        <div class="icon">
                            <i class="bi bi-hand-thumbs-up"></i>
                        </div>
                        <div class="content">
                            <h4 class="feature-title"><a href="{{ route('sobre-nos') }}">Pensando no colaborador</a></h4>
                            <p class="description">Um sistema pensando tanto na necessidade do gestor quanto na praticidade de uso de seu colaborador</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="service-section pt-70 pb-75 pt-lg-60 pb-lg-15">
				<div class="container">


					<div class="row align-items-center">
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<div class="icon">
									<i class="bi bi-hourglass-split"></i>
								</div>
								<h3 class="service-title"><a href="sobre-nos.php">Origem Real</a>
								</h3>
								<p class="description">Nascemos da experiência prática de contadores com mais de 40 anos no setor.</p>
								<a href="sobre-nos.php" class="more-btn">Saiba Mais <i class="bi bi-chevron-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
								<div class="icon">
									<i class="bi bi-columns-gap"></i>
								</div>
								<h3 class="service-title"><a href="sobre-nos.php">Interface Amigável</a>
								</h3>
								<p class="description">Visual simples, mascote simpática e linguagem clara para facilitar o uso diário.</p>
								<a href="sobre-nos.php" class="more-btn">Quero Ver <i class="bi bi-chevron-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
								<iframe width="100%" height="290px" id="video" style="border-radius: 30px;" src="https://www.youtube.com/embed/WM2K3A3iqA4" title="VilaSoftware Institucional Desenvolvimento de Software" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
							</div>
						</div>

					</div>

				</div>
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
								<div class="icon">
									<i class="bi bi-envelope-open-heart"></i>
								</div>
								<h3 class="service-title"><a href="sobre-nos.php">Amigo Digital</a>
								</h3>
								<p class="description">Somos mais que software, somos o parceiro que acompanha sua contabilidade de perto.</p>
								<a href="sobre-nos.php" class="more-btn">Conhecer Agora <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
								<div class="icon">
									<i class="bi bi-graph-up-arrow"></i>
								</div>
								<h3 class="service-title"><a href="sobre-nos.php">Foco Colaborativo</a>
								</h3>
								<p class="description">Aproximamos escritórios e clientes, centralizando tarefas, documentos e comunicação.</p>
								<a href="sobre-nos.php" class="more-btn">Conhecer Agora <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="service-wrap-2 wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
								<div class="icon">
									<i class="bi bi-rocket-takeoff"></i>
								</div>
								<h3 class="service-title"><a href="sobre-nos.php">Escalável Sempre</a>
								</h3>
								<p class="description">Serve desde pequenos escritórios até grandes empresas, crescendo junto com você.</p>
								<a href="sobre-nos.php" class="more-btn">Conhecer Agora <i class="bi bi-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</section>
            <section class="chose-section pt-120 pb-75 pt-lg-60 pb-lg-15">
				<div class="container">
					<div class="row mb-35">
						<div class="col-lg-6 mb-45 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
							<div class="title-one mb-40">
								<h2 class="title text-heding2">Por que escolher a Vila?</h2>
							</div>
							<div class="faq-que-list mb-45 pe-xxl-5">
								<div class="accordion accordion-one" id="accordion3">
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingOne">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
												E se meu escritório for pequeno demais?
											</button>
										</h2>
										<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion3">
											<div class="accordion-body">
												<p>Não importa o tamanho, temos humanidade e competência para estar junto a uma grande empresa contábil, como também para lhe acompanhar desde o inicio até sua ascensão.
													Pois desejamos estar presente em seu nascimento até sua pós graduação.
												</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingTwo">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Qual o beneficio para meus clientes?
											</button>
										</h2>
										<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion3">
											<div class="accordion-body">
												<p>Facilitar, otimizar e estreitar a comunicação entre voce e seu cliente.</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingThree">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												E se eu já tiver outro sistema?
											</button>
										</h2>
										<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordion3">
											<div class="accordion-body">
												<p>Voce poderá nos conhecer e sabera nosso diferencial</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 mb-45 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
							<div class="img-holder ps-xxl-4">
								<img class="w-100" src="./images/vila/robo-cao-2 (1).png" alt="media">
							</div>
						</div>
					</div>

				</div>
			</section>
            <section class="faq-section pt-70 pb-25 pb-lg-15">
				<div class="container">
					<div class="title-one mb-70">
						<h2 class="title text-center text-heding2 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">5 Perguntas Frequentes!</h2>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="img-wrapper-three position-relative z-1 mb-45 wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
								<img class="w-100" src="./images/vila/robo-cao-3 (1).png" alt="media">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="faq-que-list faq-style-2 mb-45 wow fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
								<div class="accordion accordion-one" id="accordion4">
									<div class="accordion-item">
										<h2 class="accordion-header" id="heading2s">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2s" aria-expanded="false" aria-controls="collapse2s">
												Como funciona a Vila Contábil?
											</button>
										</h2>
										<div id="collapse2s" class="accordion-collapse collapse" aria-labelledby="heading2s" data-bs-parent="#accordion4">
											<div class="accordion-body">
												<p>É um sistema online que organiza tarefas, documentos e obrigações contábeis, aproximando clientes e escritórios.</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingTwo2s">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwos">
												Preciso instalar algum programa?
											</button>
										</h2>
										<div id="collapseTwos" class="accordion-collapse collapse" aria-labelledby="headingTwo2s" data-bs-parent="#accordion4">
											<div class="accordion-body">
												<p>Não! A Vila é 100% online. Basta acessar de qualquer dispositivo com internet e pronto.</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingThrees">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThrees" aria-expanded="false" aria-controls="collapseThrees">
												E quanto à segurança dos dados?
											</button>
										</h2>
										<div id="collapseThrees" class="accordion-collapse collapse" aria-labelledby="headingThrees" data-bs-parent="#accordion4">
											<div class="accordion-body">
												<p>Usamos criptografia e servidores seguros, garantindo proteção total de informações contábeis e confidenciais.</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingFours">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFours" aria-expanded="false" aria-controls="collapseFours">
												Posso testar antes de contratar?
											</button>
										</h2>
										<div id="collapseFours" class="accordion-collapse collapse" aria-labelledby="headingFours" data-bs-parent="#accordion4">
											<div class="accordion-body">
												<p>Sim! Oferecemos demonstrações gratuitas para você conhecer cada recurso do sistema sem compromisso.</p>
											</div>
										</div>
									</div>
									<div class="accordion-item">
										<h2 class="accordion-header" id="headingFives">
											<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFives" aria-expanded="false" aria-controls="collapseFives">
												Atende só escritórios de contabilidade?
											</button>
										</h2>
										<div id="collapseFives" class="accordion-collapse collapse" aria-labelledby="headingFives" data-bs-parent="#accordion4">
											<div class="accordion-body">
												<p>Não. Também serve para empresários e gestores que precisam organizar tarefas, documentos e prazos.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>



<section class="theme-bg app-section pt-85 pb-30">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-xl-7">
							<div class="title-one text-xl-start text-center mb-50">
								<h2 class="title text-white">Quero Simplificar Agora!</h2>
								<p class="text-white opacity-75">Descubra o amigo digital que transforma sua rotina contábil.
								</p>
							</div>
						</div>
						<div class="col-xl-5">
							<div class="d-md-flex justify-content-xl-end justify-content-center text-center mb-50">
								<a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" class="ht-btn bstyle style-2 me-xl-3">Quero agora!</a>
							</div>
						</div>
					</div>
				</div>
			</section>
@endsection