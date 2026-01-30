@extends('layouts.app')

@section('title', 'Vila Contábil')

@section('content')
@php use Illuminate\Support\Facades\Storage; @endphp
{{-- Mantém visual do PHP básico --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="main-page-wrapper">

  {{-- (se você tiver estes includes no Laravel, mantenha) --}}
  {{-- @include('preloader') --}}
  {{-- @include('header') --}}

  <main>

    {{-- HERO / PAGE TITLE igual ao PHP --}}
<div class="page-title-area">
                <div class="breadcrumb-wrapper background-image" style="background-image: url(&quot;./images/vila/bg-ultrawide-3.webp&quot;);">
                    <div class="container">
                        <div class="breadcrumb-content text-center">
                            <h1 class="text-center text-white">Vila-Class</h1>
                            <h5 class="text-center text-white">Área de classificados da Vilasoftware</h5>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <i class="bi bi-person-lines-fill text-white" style="font-size: 40px;"></i>
                                    <p class="text-center text-white">Para você profissional divulgar sua atividade</p>
                                    <a href="#" class="ht-btn bs-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Faça aqui seu cadastro</a>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <i class="bi bi-person-add text-white" style="font-size: 40px;"></i>
                                    <p class="text-center text-white">Para você que procura um profissional </p>
                                    <a href="#profissionais" class="ht-btn bs-btn">Encontre aqui!</a>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

    {{-- LISTAGEM + FILTROS (layout 3/9 igual ao PHP) --}}
    <section class="team-section pt-140 pt-lg-100 pb-25 pb-lg-15" id="profissionais">
      <div class="container">

        <div class="row">
          {{-- FILTROS à esquerda --}}
         <div class="col-lg-3">
  <div class="card filters_card">
    <p class="h3 text-primary mb-3">Busca Avançada</p>

    <p>Pesquisar por nome:</p>
    <input type="text"
           id="nameFilter"
           class="form-control mb-3"
           placeholder="Digite um nome..."
           value="{{ request('name', '') }}">

    <p>Pesquisar por especialidade:</p>
    <select name="specialities" id="specialtyFilter" class="form-select mb-3">
      <option value="">Todas</option>

      @foreach($specialties as $spec)
        @php
          // suporta: Model, stdClass, array
          $specId   = is_array($spec) ? ($spec['id'] ?? null) : ($spec->id ?? null);
          $specName = is_array($spec) ? ($spec['name'] ?? '') : ($spec->name ?? '');
        @endphp

        @if($specId !== null)
          <option value="{{ $specId }}" {{ (string)request('specialty', '') == (string)$specId ? 'selected' : '' }}>
            {{ $specName }}
          </option>
        @endif
      @endforeach
    </select>

    <p>Pesquisar por estado:</p>
<select name="state" id="stateFilter" class="form-select mb-3">
  <option value="">Todos</option>
  @foreach($ufs as $uf => $label)
    <option value="{{ $uf }}" {{ request('state','') === $uf ? 'selected' : '' }}>
      {{ $label }} ({{ $uf }})
    </option>
  @endforeach
</select>

    <p>Pesquisar por cidade:</p>
    <select name="city" id="cityFilter" class="form-select">
      <option value="">Todas</option>
    </select>
  </div>
</div>

          {{-- LISTA à direita --}}
          <div class="col-lg-9">

            <div class="row justify-content-start align-items-stretch" id="professionalsList">
              @foreach($profissionais as $prof)
                <div class="col-xl-3 col-lg-4 col-md-6 d-flex mb-3">
                  <div class="team-wrap-2 w-100 h-100">
                    <div class="team-thumb">
                    

                    <img class="img-fluid" style="border-radius:0px"
                        src="{{ $prof->photo_url ? Storage::url($prof->photo_url) : asset('images/default-user.png') }}"
                        alt="team">

                      <div class="team-social">
                        @if(!empty($prof->facebook))
                          <a href="{{ $prof->facebook }}" target="_blank"><i class="bi bi-facebook"></i></a>
                        @endif
                        @if(!empty($prof->instagram))
                          <a href="{{ $prof->instagram }}" target="_blank"><i class="bi bi-instagram"></i></a>
                        @endif
                        @if(!empty($prof->linkedin))
                          <a href="{{ $prof->linkedin }}" target="_blank"><i class="bi bi-linkedin"></i></a>
                        @endif
                      </div>
                    </div>

                    <div class="content">
                      <h4 class="name">
                        {{-- Link para acesso ao perfil do usuario --}}
                        {{-- "{{ route('profissional', $prof->id) }}" --}}
                        <a>{{ $prof->name }}</a>
                      </h4>

                     <p class="designation">
                        @php
                            $specText = '';

                            if (!empty($prof->specialties_text)) {
                            $specText = $prof->specialties_text;
                            } elseif (isset($prof->specialties) && $prof->specialties && $prof->specialties->count()) {
                            $specText = $prof->specialties->pluck('name')->sort()->implode(', ');
                            }
                        @endphp

                        {{ $specText }}
                        </p>

                      <div class="d-flex justify-content-center">
                        <i class="bi bi-geo-alt"></i>
                        <p class="location">
                          {{ $prof->city ?? '' }}{{ ($prof->city && $prof->state) ? ',' : '' }} {{ $prof->state ?? '' }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

          </div>
        </div>

      </div>
    </section>

  </main>

  {{-- @include('footer') --}}
  {{-- @include('modal-login-register') --}}

</div>
@endsection


@push('styles')
<style>
  #professionalsList{

  
margin-bottom:1em;
  }
/* --- Colunas viram flex para o card ocupar 100% --- */
#professionalsList > [class*="col-"]{
  display: flex,
  
}

/* --- Card: estrutura e visual base --- */
.team-wrap-2{
  
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;

  background: #fff;
  border-radius: 10px;
  overflow: hidden; /* evita “vazar” */
  box-shadow: 0 5px 15px rgba(0,0,0,.08);
  margin-bottom: 24px;
}

/* --- Imagem/Thumb com altura fixa --- */
.team-thumb{
  position: relative;
  height: 220px;
  flex: 0 0 auto;
  overflow: hidden;
}
.team-thumb img{
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* --- Social overlay --- */
.team-social{
  position: absolute;
  left: 0; right: 0;
  bottom: 10px;

  display: flex;
  justify-content: center;
  gap: 10px;

  opacity: 0;
  transform: translateY(8px);
  transition: .2s ease;
}
.team-thumb:hover .team-social{
  opacity: 1;
  transform: translateY(0);
}
.team-social a{
  width: 36px;
  height: 36px;
  border-radius: 50%;

  display: flex;
  align-items: center;
  justify-content: center;

  background: #fff;
  color: #111;
  text-decoration: none;
  box-shadow: 0 5px 15px rgba(0,0,0,.10);
}

/* --- Conteúdo: ocupa o restante do card --- */
.team-wrap-2 .content{
  flex: 1 1 auto;
  min-width: 0; /* CRUCIAL em flex pra não estourar */
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  padding: 14px 14px 18px;
  text-align: center;
}

/* --- Nome (máx 2 linhas) --- */
.team-wrap-2 .name{
  margin-bottom: 6px;
}
.team-wrap-2 .name a{
  color: #111;
  text-decoration: none;
  font-weight: 700;

  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;

  overflow: hidden;
  overflow-wrap: anywhere; /* quebra palavras/links enormes */
  word-break: break-word;
}

/* --- Especialidades (máx 2 linhas + reserva espaço fixo) --- */
.team-wrap-2 .designation{
  margin: 0;
  color: #666;
  font-size: .9rem;
  line-height: 1.2;

  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;

  overflow: hidden;
  overflow-wrap: anywhere;
  word-break: break-word;

  min-height: calc(2 * 1.2em); /* mantém mesma altura mesmo com texto curto */
}

/* --- Linha de localização: 1 linha com reticências --- */
.team-wrap-2 .content .d-flex{
  margin-top: 10px;
}
.team-wrap-2 .location{
  margin: 0 0 0 6px;
  color: #666;

  max-width: 100%;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

/* --- Card dos filtros (esquerda) --- */
.filters_card{
  padding: 16px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,.08);
}
</style>
@endpush



@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function() {

  // Ajuste para sua rota GET que retorna a página (mesmo blade)
  const LIST_URL = "{{ route('profissionais') }}";

  // Carrega cidades por estado (Laravel endpoint)
  // Você vai criar depois: GET /ajax/cities?state=SP => ["São Paulo","Campinas"...]
  const CITIES_URL = "{{ route('ajax.cities') }}";

  function reloadList(){
    let name      = $('#nameFilter').val();
    let specialty = $('#specialtyFilter').val();
    let state     = $('#stateFilter').val();
    let city      = $('#cityFilter').val();

    $.get(LIST_URL, { name, specialty, state, city }, function(html){
      let newList = $(html).find('#professionalsList').html();
      $('#professionalsList').html(newList);
    });
  }

  // Atualiza cidades conforme estado
  $('#stateFilter').on('change', function(){
    let state = $(this).val();
    $('#cityFilter').html('<option value="">Todas</option>');

    if(state){
      $.get(CITIES_URL, { state: state }, function(data){
        // data pode vir como array json
        let cities = Array.isArray(data) ? data : JSON.parse(data);
        cities.forEach(function(city){
          $('#cityFilter').append(`<option value="${city}">${city}</option>`);
        });
      });
    }

    reloadList();
  });

  // Recarrega ao mudar filtros
  $('#specialtyFilter, #cityFilter').on('change', reloadList);

  // Nome em tempo real
  $('#nameFilter').on('keyup', function(){
    reloadList();
  });

});
</script>
@endpush
