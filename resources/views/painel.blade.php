@extends('layouts.app')

@section('title', 'Painel - Vila Contábil')

@section('content')

{{-- FontAwesome / Bootstrap Icons (igual ao PHP) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<section class="breadcrumb-area">

</section>

<section class="team-details-content pt-70 pb-70 pt-lg-100 pb-lg-60">
  <div class="container">

    {{-- Alerts (mantém) --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="biography-content-wrap">
      <div class="row align-items-center mb-35">
        <div class="col-xl-5 col-lg-6">
          <div class="team-biography text-lg-start text-center w-100">
            <div class="profile-image-wrapper">
            
            <img
              id="profileImage"
              src="{{ Auth::user()->photo_url ? Storage::url(Auth::user()->photo_url) : asset('images/default-user.png') }}"
              alt="Foto de perfil"
            />

            <div class="profile-image-overlay" id="changeAvatarBtn">
              <i class="bi bi-camera-fill"></i>
              <span>Alterar foto</span>
            </div>
          </div>

            
           <form enctype="multipart/form-data">
          @csrf
          <input type="file" id="avatar" name="avatar" accept="image/*" hidden>
        </form>

        <div id="avatarMsg" class="small mt-2"></div>

            <div class="mt-2">
              <span
                id="accountStatusBadge"
                class="badge {{ Auth::user()->is_active ? 'bg-success' : 'bg-secondary' }}"
              >
                {{ Auth::user()->is_active ? 'Ativa' : 'Inativa' }}
              </span>
            </div>
          </div>

          {{-- Toggle “Exibir conta” (visual igual ao antigo) --}}
          <div class="d-flex align-items-center justify-content-center gap-3 mb-3" id="accountStatusBlock">
            <label class="form-check form-switch d-flex align-items-center justify-content-center mb-0">
              <input
                class="form-check-input"
                type="checkbox"
                id="accountActiveToggle"
                {{ Auth::user()->is_active ? 'checked' : '' }}
              >
              <span class="form-check-label mx-2">Exibir conta</span>
            </label>

            <div id="accountStatusMsg" class="small text-muted ms-3" style="display:none;"></div>
          </div>

      
        </div>

        {{-- COL DIREITA: DADOS (igual ao PHP antigo) --}}
        <div class="col-xl-7 col-lg-6 ps-xl-0">
          <div class="biography-content mb-45">

            {{-- Especialidades em “cards” --}}
            <div class="designation mb-2">
              @if(Auth::user()->specialties && Auth::user()->specialties->count() > 0)
                @foreach(Auth::user()->specialties as $specialty)
                  <span class="specialty-card">{{ $specialty->name }}</span>
                @endforeach

                <a href="#" class="edit-field ms-1" data-field="specialties" data-ids="{{ Auth::user()->specialties->pluck('id')->implode(',') }}">
                  <i class="bi bi-pencil-square"></i>
                </a>
              @else
                <button class="btn btn-primary edit-field" data-field="specialties" style="color:white;" data-ids="" type="button">
                  <i class="bi bi-pencil-fill"></i> Adicionar Especialidade
                </button>
              @endif
            </div>

            {{-- Nome --}}
            <h2 class="name">
              {{ Auth::user()->name }}
              <a href="#" class="edit-field ms-1" data-field="name" data-value="{{ Auth::user()->name }}">
                <i class="bi bi-pencil-square"></i>
              </a>
            </h2>

            {{-- Descrição --}}
            <p class="description">
              {{ Auth::user()->description ?: 'Nenhuma descrição cadastrada.' }}
              <a href="#" description class="edit-field ms-1" data-field="description" data-value="{{ Auth::user()->description }}">
                <i class="bi bi-pencil-square"></i>
              </a>
            </p>

            {{-- Telefone --}}
            <h5 class="addres-line" style="max-width: 500px;">
              <span><i class="bi bi-telephone-outbound"></i></span>
              {{ Auth::user()->phone ?: 'Não cadastrado' }}
              <a href="#" class="edit-field ms-1" data-field="phone" data-value="{{ Auth::user()->phone }}">
                <i class="bi bi-pencil-square"></i>
              </a>
            </h5>

            {{-- WhatsApp --}}
            <h5 class="addres-line">
              <span><i class="bi bi-whatsapp"></i></span>
              {{ Auth::user()->whatsapp ?: 'Não cadastrado' }}
              <a href="#" class="edit-field ms-1" data-field="whatsapp" data-value="{{ Auth::user()->whatsapp }}">
                <i class="bi bi-pencil-square"></i>
              </a>
            </h5>

            {{-- Email (bloqueado) --}}
            <h5 class="addres-line" style="max-width: 500px;">
              <span><i class="bi bi-envelope-paper"></i></span>
              {{ Auth::user()->email }}
              <span class="ms-2 text-muted ms-1" title="E-mail cadastrado e não editável pelo usuário">
                <i class="bi bi-lock-fill" style="font-size:0.95rem;"></i>
              </span>
            </h5>

            {{-- Localização (montagem igual ao PHP) --}}
            @php
              $loc_parts = [];
              if (!empty(Auth::user()->address)) $loc_parts[] = e(Auth::user()->address);
              if (!empty(Auth::user()->state))   $loc_parts[] = e(Auth::user()->state);
              if (!empty(Auth::user()->city))    $loc_parts[] = e(Auth::user()->city);
              if (!empty(Auth::user()->cep))     $loc_parts[] = e(Auth::user()->cep);
              $hasLocation = !empty($loc_parts);
            @endphp

            <h5 class="addres-line font-bold" style="max-width: 500px;">
              <span><i class="bi bi-geo-alt"></i></span>

              @if($hasLocation)
                <span class="location-display">{!! implode(', ', $loc_parts) !!}</span>
                <a href="#"
                   class="edit-field ms-1"
                   title="Editar localização"
                   data-field="location"
                   data-cep="{{ e(Auth::user()->cep ?? '') }}"
                   data-street="{{ e(Auth::user()->address ?? '') }}"
                   data-city="{{ e(Auth::user()->city ?? '') }}"
                   data-state="{{ e(Auth::user()->state ?? '') }}">
                  <i class="bi bi-pencil-square" style="font-size:.95rem; opacity:.8;"></i>
                </a>
              @else
                <span class="text-muted" style="font-weight: 500; font-family: Satoshi-Medium">Localização não cadastrada</span>
                <a href="#"
                   class="edit-field ms-1"
                   title="Adicionar localização"
                   data-field="location"
                   data-cep=""
                   data-street=""
                   data-city=""
                   data-state="">
                  <i class="bi bi-pencil-square" style="font-size:.95rem; opacity:.8;"></i>
                </a>
              @endif
            </h5>

            {{-- Redes sociais com muted --}}
            <div class="team-social-2 mt-3 d-flex align-items-center gap-2">
              @php $fb = trim(Auth::user()->facebook ?? ''); @endphp
              <a href="#" class="social-icon edit-field fb {{ $fb ? '' : 'muted' }}"
                 data-field="facebook" data-value="{{ e($fb) }}" title="Editar Facebook">
                <i class="bi bi-facebook"></i>
              </a>

              @php $ln = trim(Auth::user()->linkedin ?? ''); @endphp
              <a href="#" class="social-icon edit-field lk {{ $ln ? '' : 'muted' }}"
                 data-field="linkedin" data-value="{{ e($ln) }}" title="Editar LinkedIn">
                <i class="bi bi-linkedin"></i>
              </a>

              @php $ig = trim(Auth::user()->instagram ?? ''); @endphp
              <a href="#" class="social-icon edit-field ig {{ $ig ? '' : 'muted' }}"
                 data-field="instagram" data-value="{{ e($ig) }}" title="Editar Instagram">
                <i class="bi bi-instagram"></i>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

    {{-- Modal genérico de edição (igual ao PHP antigo) --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content p-3">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body" id="modalBody"></div>

        <div class="modal-footer">
          <div id="editMsg" class="me-auto"></div>
          <button type="button" class="btn btn-primary" id="saveField">Salvar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

@if(!Auth::user()->profile_completed)
  {{-- <div class="modal fade"
      id="firstLoginModal"
      tabindex="-1"
      data-bs-backdrop="static"
      data-bs-keyboard="false"
      aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Complete seu perfil</h5>
        </div>

        <div class="modal-body">
          <p class="text-muted mb-3">
            Para continuar, complete todas as informações abaixo.
          </p>

  <form id="firstLoginForm">
    @csrf

    <div class="row g-3">



      <div class="col-12 col-md-6">
        <label class="form-label">Nome*</label>
        <input type="text" name="name" class="form-control" required>
      </div>


      <div class="col-12 col-md-6">
        <label class="form-label">Telefone*</label>
        <input type="text" name="phone" class="form-control" required>
      </div>

      <div class="col-12 col-md-6">
        <label class="form-label">WhatsApp*</label>
        <input type="text" name="whatsapp" class="form-control" required>
      </div>


      <div class="col-12 col-md-6">
        <label class="form-label">CEP*</label>
        <input type="text" name="cep" id="firstCep" class="form-control" required>
      </div>

  <div class="col-12 col-md-6">
    <label class="form-label">Estado*</label>

    @php
      $currentUf = strtoupper(trim(Auth::user()->state ?? ''));

      $ufs = [
        'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo','GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
        'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RJ'=>'Rio de Janeiro','RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','RR'=>'Roraima','SC'=>'Santa Catarina','SP'=>'São Paulo','SE'=>'Sergipe','TO'=>'Tocantins'
      ];
    @endphp

    <select name="state" id="firstState" class="form-select" required>
      <option value="">Selecione</option>

      @foreach($ufs as $uf => $label)
        <option value="{{ $uf }}" {{ $currentUf === $uf ? 'selected' : '' }}>
          {{ $label }} ({{ $uf }})
        </option>
      @endforeach
    </select>
  </div> --}}


      {{-- <div class="col-12 col-md-6">
        <label class="form-label">Cidade*</label>
        <input type="text" name="city" id="firstCity" class="form-control" required>
      </div> --}}

      {{-- <div class="col-12">
        <label class="form-label">Endereço*</label>
        <input type="text" name="address" id="firstAddress" class="form-control" required>
      </div>

          <div class="col-12">
        <label class="form-label">Especialidades* (escolha pelo menos uma)</label>
        <select name="specialties[]" class="form-select" multiple required style="min-height: 180px;">
          @foreach($specialties as $spec)
            <option value="{{ $spec->id }}">{{ $spec->name }}</option>
          @endforeach
        </select>
        <small class="text-muted">Dica: segure Ctrl (Windows) / Cmd (Mac) para selecionar várias.</small>
      </div>


      <div class="col-12">
        <label class="form-label">Descrição profissional*</label>
        <textarea name="description" class="form-control" rows="5" required></textarea>
      </div> --}}


    {{-- </div>
  </form> --}}


          {{-- <div id="firstLoginMsg" class="mt-2"></div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary w-100" id="saveFirstProfile">
            Salvar e continuar
          </button>
        </div> --}}

    </div>
  </div>
</div>
@endif

@endsection

@push('styles')
<style>
  .profile-image-wrapper{
  position: relative;
  width: 100%;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
}

.profile-image-wrapper img{
  width: 100%;
  height: 100%;
  display: block;
  object-fit: cover;
  border-radius: 12px;
}

.profile-image-overlay{
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.55);
  color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
  font-weight: 600;
  font-size: 0.95rem;
  opacity: 0;
  transition: opacity .25s ease;
}

.profile-image-wrapper:hover .profile-image-overlay{
  opacity: 1;
}

.profile-image-overlay i{
  font-size: 1.5rem;
}
  .edit-avatar-link{
  color:#0d6efd;
  text-decoration:none;
  font-weight:600;
}
.edit-avatar-link:hover{ text-decoration:underline; }

  .specialty-card{
    display:inline-block;
    padding:6px 10px;
    margin:0 6px 6px 0;
    border-radius:12px;
    background:#f2f6ff;
    color:#0d6efd;
    font-size:.85rem;
    font-weight:600;
  }

  .edit-field{
    color:#0d6efd;
    text-decoration:none;
    font-weight:600;
  }
  .edit-field:hover{ text-decoration:underline; }

  .dashboard-menu{
    background:#fff;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    overflow:hidden;
  }
  .dashboard-menu .nav-link{
    padding:15px 20px;
    color:#333;
    text-decoration:none;
    border-bottom:1px solid #f1f1f1;
    display:flex;
    align-items:center;
    gap:10px;
    transition:all .2s ease;
  }
  .dashboard-menu .nav-link:hover,
  .dashboard-menu .nav-link.active{
    background:#0d6efd;
    color:#fff;
  }

  .social-icon{
    width:42px;height:42px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#f7f7f7;
    color:#111;
    text-decoration:none;
  }
  .social-icon.muted{
    opacity:.35;
  }

  .dashboard-content{
    background:#fff;
    border-radius:10px;
    padding:40px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const cepInput   = document.getElementById('firstCep');
  const stateSel   = document.getElementById('firstState');
  const cityInput  = document.getElementById('firstCity');
  const addrInput  = document.getElementById('firstAddress');
  const msg        = document.getElementById('firstLoginMsg');

  if (!cepInput || !stateSel || !cityInput || !addrInput) return;

  function onlyDigits(v){ return (v || '').replace(/\D/g,''); }

  async function fetchCep(cepRaw){
    const cep = onlyDigits(cepRaw);
    if (cep.length !== 8) return;

    msg.innerHTML = '<span class="text-muted">Buscando endereço...</span>';

    try {
      const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`, {
        headers: { 'Accept': 'application/json' }
      });
      const data = await res.json();

      if (!res.ok || data.erro) {
        msg.innerHTML = '<span class="text-danger">CEP não encontrado.</span>';
        return;
      }

      // Preenche campos
      const logradouro = data.logradouro || '';
      const bairro     = data.bairro || '';
      const cidade     = data.localidade || '';
      const uf         = data.uf || '';

      // endereço: logradouro + bairro (opcional)
      const endereco = [logradouro, bairro].filter(Boolean).join(' - ');

      if (endereco) addrInput.value = endereco;
      if (cidade)   cityInput.value = cidade;

      // Seleciona UF no select
      if (uf) {
        stateSel.value = uf;
      }

      msg.innerHTML = '<span class="text-success">Endereço preenchido pelo CEP.</span>';
      setTimeout(() => { msg.innerHTML = ''; }, 2500);

    } catch (e) {
      msg.innerHTML = '<span class="text-danger">Falha ao consultar CEP.</span>';
    }
  }

  // Dispara ao sair do campo
  cepInput.addEventListener('blur', () => fetchCep(cepInput.value));

  // Opcional: dispara quando completar 8 dígitos
  cepInput.addEventListener('input', () => {
    const cep = onlyDigits(cepInput.value);
    if (cep.length === 8) fetchCep(cep);
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const input = document.getElementById('avatar');
  const overlay = document.getElementById('changeAvatarBtn');
  const img = document.getElementById('profileImage');
  const msg = document.getElementById('avatarMsg');

  overlay?.addEventListener('click', () => {
    input?.click();
  });

  input?.addEventListener('change', async () => {
    if (!input.files || !input.files[0]) return;

    msg.innerHTML = 'Enviando...';

    const fd = new FormData();
    fd.append('avatar', input.files[0]);
    fd.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try {
      const res = await fetch("{{ route('upload.avatar') }}", {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: fd
      });

      const data = await res.json();
      if (!data.success) throw new Error(data.message || 'Erro no upload');

      img.src = "{{ url('') }}" + data.photo_url + '?v=' + Date.now();
      msg.innerHTML = '<span class="text-success">Foto atualizada!</span>';
      input.value = '';

    } catch (err) {
      msg.innerHTML = '<span class="text-danger">' + err.message + '</span>';
      input.value = '';
    }
  });
});

</script>
@if(!Auth::user()->profile_completed)

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modalEl = document.getElementById('firstLoginModal');
  const modal = new bootstrap.Modal(modalEl);
  modal.show();

  document.getElementById('saveFirstProfile').addEventListener('click', function () {
    const form = document.getElementById('firstLoginForm');
    const msg = document.getElementById('firstLoginMsg');

      fetch("{{ route('profile.complete') }}", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
      },
      body: new FormData(form)
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        location.reload();
      } else {
        console.log(data.message);
      }
    });
  });
});
</script>
@endif

<script>
/** ========= CEP Autofill (reutilizável) ========= */
function initCepAutofill(formEl) {
  const cepEl = formEl.querySelector('[data-cep-field="cep"]');
  const stateEl = formEl.querySelector('[data-cep-field="state"]');
  const cityEl = formEl.querySelector('[data-cep-field="city"]');
  const addressEl = formEl.querySelector('[data-cep-field="address"]');
  const feedbackEl = formEl.querySelector('[data-cep-feedback]');
  const statusEl = formEl.querySelector('[data-cep-status]');

  if (!cepEl) return;

  let timer = null;
  let controller = null;
  let lastCep = null;
  let lastData = null;

  const onlyDigits = (s) => (s || "").replace(/\D/g, "");
  const formatCep = (v) => {
    const d = onlyDigits(v).slice(0, 8);
    return d.length > 5 ? `${d.slice(0, 5)}-${d.slice(5)}` : d;
  };

  const setStatus = (txt, cls = "text-muted") => {
    if (!statusEl) return;
    statusEl.className = `form-text ${cls}`;
    statusEl.textContent = txt || "";
  };

  const setLoading = (on) => {
    if (stateEl) stateEl.disabled = !!on;
    if (on) setStatus("Buscando endereço...", "text-muted");
  };

  const setValid = () => {
    cepEl.classList.remove("is-invalid");
    cepEl.classList.add("is-valid");
    cepEl.setCustomValidity("");
    if (feedbackEl) feedbackEl.textContent = "";
    setStatus("Endereço preenchido pelo CEP.", "text-success");
    setTimeout(() => setStatus(""), 2000);
  };

  const setInvalid = (msg) => {
    cepEl.classList.remove("is-valid");
    cepEl.classList.add("is-invalid");
    cepEl.setCustomValidity(msg || "CEP inválido.");
    if (feedbackEl) feedbackEl.textContent = msg || "CEP inválido.";
    setStatus(msg || "CEP inválido.", "text-danger");
  };

  const fire = (el, type) => el && el.dispatchEvent(new Event(type, { bubbles: true }));

  const applyData = (data) => {
    // UF
    if (stateEl && data.uf) {
      stateEl.value = data.uf;
      fire(stateEl, "change");
    }

    // Cidade
    if (cityEl) {
      cityEl.value = data.localidade || "";
      fire(cityEl, "input");
    }

    // Endereço: logradouro + bairro (se existir)
    if (addressEl) {
      const parts = [data.logradouro, data.bairro].filter(Boolean);
      addressEl.value = parts.join(" - ");
      fire(addressEl, "input");
    }
  };

  const lookup = async () => {
    const cepDigits = onlyDigits(cepEl.value);

    // limpa enquanto digita
    cepEl.classList.remove("is-valid", "is-invalid");
    cepEl.setCustomValidity("");
    if (feedbackEl) feedbackEl.textContent = "";
    setStatus("");

    if (cepDigits.length !== 8) return;

    if (cepDigits === lastCep && lastData) {
      applyData(lastData);
      setValid();
      return;
    }

    if (controller) controller.abort();
    controller = new AbortController();

    setLoading(true);

    try {
      const res = await fetch(`https://viacep.com.br/ws/${cepDigits}/json/`, {
        headers: { Accept: "application/json" },
        signal: controller.signal,
      });

      if (!res.ok) throw new Error("Falha ao consultar CEP.");
      const data = await res.json();
      if (data.erro) throw new Error("CEP não encontrado.");

      lastCep = cepDigits;
      lastData = data;

      applyData(data);
      setValid();
    } catch (err) {
      if (err.name === "AbortError") return;
      setInvalid(err.message || "CEP inválido.");
    } finally {
      setLoading(false);
    }
  };

  // máscara + debounce
  cepEl.addEventListener("input", () => {
    cepEl.value = formatCep(cepEl.value);
    clearTimeout(timer);
    timer = setTimeout(lookup, 300);
  });

  // blur também
  cepEl.addEventListener("blur", lookup);

  // se já vier com CEP (edição), tenta preencher ao abrir
  if (onlyDigits(cepEl.value).length === 8) {
    lookup();
  }
}
</script>

<script>

document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('editModal');
  if (!modalEl) return;

  // Quando o modal FECHAR (X, ESC, clique fora, etc.)
  modalEl.addEventListener('hidden.bs.modal', () => {
    // volta pro painel "zerado"
    window.location.href = "{{ route('painel') }}";
    // ou: window.location.reload();
  });

  // Se quiser capturar especificamente o X:
  modalEl.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
    btn.addEventListener('click', () => {
      // aqui o hidden.bs.modal vai disparar depois e fazer o redirect
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('editModal');
  const modal   = bootstrap.Modal.getOrCreateInstance(modalEl);
  const body    = document.getElementById('modalBody');
  const title   = document.getElementById('editModalLabel');
  const msgBox  = document.getElementById('editMsg');

  let currentField = null;

  // Monte aqui as opções de especialidades vindas do backend (você já tem $specialties no painel)
  const specialtiesOptions = `
    @foreach($specialties as $spec)
      <option value="{{ $spec->id }}">{{ $spec->name }}</option>
    @endforeach
  `;

  function setMsg(html) {
    msgBox.innerHTML = html || '';
  }

  function templateFor(field, triggerEl) {
    const value = (triggerEl.dataset.value || '').trim();

    if (field === 'name') {
      title.textContent = 'Editar nome';
      return `
        <label class="form-label">Nome*</label>
        <input type="text" class="form-control" name="value" value="${value.replace(/"/g,'&quot;')}" required>
      `;
    }

    if (field === 'description') {
      title.textContent = 'Editar descrição';
      return `
        <label class="form-label">Descrição*</label>
        <textarea class="form-control" name="value" rows="6" required>${value}</textarea>
      `;
    }

   if (field === 'phone') {
        title.textContent = 'Editar telefone';
        return `
          <label class="form-label">Telefone*</label>
          <input
            type="text"
            class="form-control"
            name="value"
            data-mask="phoneBR"
            value="${value.replace(/"/g,'&quot;')}"
            required
          >
        `;
      }

        if (field === 'whatsapp') {
      title.textContent = 'Editar WhatsApp';
      return `
        <label class="form-label">WhatsApp*</label>
        <input
          type="text"
          class="form-control"
          name="value"
          data-mask="phoneBR"
          value="${value.replace(/"/g,'&quot;')}"
          required
        >
      `;
    }

    if (field === 'facebook' || field === 'instagram' || field === 'linkedin') {
      title.textContent = 'Editar ' + field;
      return `
        <label class="form-label">Link</label>
        <input type="url" class="form-control" name="value" value="${value.replace(/"/g,'&quot;')}" placeholder="https://">
        <small class="text-muted">Deixe em branco para remover.</small>
      `;
    }

if (field === 'location') {
  title.textContent = 'Editar localização';

  const cep    = triggerEl.dataset.cep || '';
  const street = triggerEl.dataset.street || '';
  const city   = triggerEl.dataset.city || '';
  const state  = triggerEl.dataset.state || '';

  // opções UF (string Blade dentro do JS)
  const ufsOptions = `
    <option value="">Selecione</option>
    @php
      $ufs = [
        'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo','GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
        'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RJ'=>'Rio de Janeiro','RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','RR'=>'Roraima','SC'=>'Santa Catarina','SP'=>'São Paulo','SE'=>'Sergipe','TO'=>'Tocantins'
      ];
    @endphp
    @foreach($ufs as $uf => $label)
      <option value="{{ $uf }}">{{ $label }} ({{ $uf }})</option>
    @endforeach
  `;

  return `
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">CEP*</label>
        <input
          type="text"
          class="form-control"
          name="cep"
          value="${cep.replace(/"/g,'&quot;')}"
          required
          placeholder="00000-000"
          inputmode="numeric"
          autocomplete="postal-code"
          data-cep-field="cep"
        >
        <div class="invalid-feedback" data-cep-feedback>CEP inválido.</div>
        <div data-cep-status class="form-text"></div>
      </div>

      <div class="col-md-8">
        <label class="form-label">Endereço*</label>
        <input
          type="text"
          class="form-control"
          name="address"
          value="${street.replace(/"/g,'&quot;')}"
          required
          autocomplete="street-address"
          data-cep-field="address"
        >
      </div>

      <div class="col-md-6">
        <label class="form-label">Cidade*</label>
        <input
          type="text"
          class="form-control"
          name="city"
          value="${city.replace(/"/g,'&quot;')}"
          required
          autocomplete="address-level2"
          data-cep-field="city"
        >
      </div>

      <div class="col-md-6">
        <label class="form-label">Estado*</label>
        <select
          class="form-select"
          name="state"
          required
          data-cep-field="state"
          data-initial-state="${state.replace(/"/g,'&quot;')}"
        >
          ${ufsOptions}
        </select>
      </div>
    </div>
  `;
}
 if (field === 'specialties') {
  title.textContent = 'Editar especialidades';
  const ids = (triggerEl.dataset.ids || '').split(',').map(s => s.trim()).filter(Boolean);

  // monta o select e depois vamos marcar selected via JS
  setTimeout(() => {
    const select = modalEl.querySelector('select[name="specialties[]"]');
    if (select) {
      [...select.options].forEach(opt => {
        opt.selected = ids.includes(opt.value);
      });
    }
  }, 0);

  return `
   
    <div class=" py-2 px-3 mb-2" role="alert" style="font-size:.9rem;">
       <label class="form-label">
      Para selecionar mais de uma especialidade, mantenha <strong>Shift</strong> pressionado ao clicar
      </label>
    </div>
    <select class="form-select" name="specialties[]" multiple required style="min-height: 180px;">
      ${specialtiesOptions}
    </select>
  `;
}

    // fallback
    title.textContent = 'Editar';
    return `
      <label class="form-label">Valor</label>
      <input type="text" class="form-control" name="value" value="${value.replace(/"/g,'&quot;')}">
    `;
  }

  // ABRIR MODAL PERSONALIZADO
  document.querySelectorAll('.edit-field').forEach(el => {
    el.addEventListener('click', (e) => {
      e.preventDefault();

      currentField = el.dataset.field;
      setMsg('');

      const isLocation = currentField === 'location';

body.innerHTML = `
  <form id="editForm" ${isLocation ? 'data-cep-autofill' : ''}>
    ${templateFor(currentField, el)}
  </form>
`;

modal.show();

// se for localização, aplica o CEP component AGORA (porque o HTML nasceu agora)
if (isLocation) {
  const form = document.getElementById('editForm');
  if (form) {
    // seta UF inicial no select (antes/independente do CEP)
    const st = form.querySelector('[data-cep-field="state"]');
    if (st && st.dataset.initialState) st.value = st.dataset.initialState;

    initCepAutofill(form);
  }
}

    });
  });

  // SALVAR
  document.getElementById('saveField')?.addEventListener('click', async () => {
    const form = document.getElementById('editForm');
    if (!form || !currentField) return;

    // valida HTML5
    if (!form.reportValidity()) return;

    setMsg('<div class="text-muted">Salvando...</div>');

    const fd = new FormData(form);
    fd.append('field', currentField);

    try {
      const res = await fetch("{{ route('profile.updateField') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json'
        },
        body: fd
      });

      const contentType = res.headers.get('content-type') || '';
      const data = contentType.includes('application/json')
        ? await res.json()
        : { success: false, message: 'Resposta inválida do servidor.' };

      if (!res.ok || !data.success) throw new Error(data.message || 'Erro ao salvar.');

      setMsg('<div class="text-success">Salvo com sucesso!</div>');
      setTimeout(() => location.reload(), 600);

    } catch (err) {
      setMsg('<div class="text-danger">' + (err.message || 'Erro ao salvar.') + '</div>');
    }
  });
});
</script>
<script>
(function () {
  const toggle = document.getElementById('accountActiveToggle');
  const badge  = document.getElementById('accountStatusBadge');
  const msg    = document.getElementById('accountStatusMsg');
  if (!toggle || !badge || !msg) return;

  let busy = false;

  toggle.addEventListener('change', async function () {
    if (busy) return;
    busy = true;

    const desired = toggle.checked ? 1 : 0;

    // UI: feedback imediato
    toggle.disabled = true;
    msg.style.display = 'block';
    msg.classList.remove('text-danger', 'text-success');
    msg.classList.add('text-muted');
    msg.textContent = 'Salvando...';

    try {
      const res = await fetch("{{ route('account.setStatus') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ is_active: desired })
      });

      const data = await res.json().catch(() => ({}));
      if (!res.ok || !data.success) {
        throw new Error(data.message || 'Erro ao atualizar status.');
      }

      const active = !!Number(data.is_active);

      // Atualiza UI com o que o servidor confirmou
      toggle.checked = active;

      badge.classList.remove('bg-success','bg-secondary');
      badge.classList.add(active ? 'bg-success' : 'bg-secondary');
      badge.textContent = active ? 'Ativa' : 'Inativa';

      msg.classList.remove('text-muted','text-danger');
      msg.classList.add('text-success');
      msg.textContent = active ? 'Conta ativada.' : 'Conta desativada.';
      setTimeout(() => msg.style.display = 'none', 2500);

    } catch (err) {
      // rollback do toggle
      toggle.checked = !toggle.checked;

      msg.classList.remove('text-muted','text-success');
      msg.classList.add('text-danger');
      msg.textContent = err.message || 'Erro ao atualizar status.';
      setTimeout(() => msg.style.display = 'none', 3500);

    } finally {
      toggle.disabled = false;
      busy = false;
    }
  });
})();
</script>

@endpush
