<!-- Modal Termos / Política -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="termsModalLabel">
          Declaro que li e estou de acordo com as condições abaixo:
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
                <p>
                    Ao clicar na confirmação dessa autorização declaro que li e compreendi as condições para o tratamento e divulgação dos meus dados pessoais no âmbito da minha utilização da plataforma de classificados online da Vilsoftware Desenvolvimento de Software Ltda.
                </p>

                <p>Autorizo a coleta e o tratamento dos meus dados pessoais contendo nome, e-mail, telefone, endereço, atividade para as seguintes finalidades, sem que tenha alguma remuneração pela divulgação:</p>
                <ol>
                    <li> Publicação e gerenciamento do meu anúncio sendo disponibilizado a nível nacional e internacional.</li>
                    <li> Comunicação sobre anúncios de meu interesse.</li>
                    <li> Garantia da segurança e qualidade do serviço.</li>
                </ol>

                <p>
                    Estou ciente de que meus dados podem ser compartilhados com outros usuários da plataforma e ou empresas para as finalidades fins objetivo do anúncio, sempre respeitando a finalidade e os princípios da LGPD.
                </p>

                <p>
                    Declaro que posso revogar este consentimento a qualquer momento através de exclusão de meu cadastro junto a plataforma e que a revogação não afetará as atividades realizadas antes dela.
                </p>




            </div>

      <div class="modal-footer">
<button type="button" class="btn-four w-100 tran3s d-block btn-terms-back" id="backToRegisterBtn">
  Voltar
</button>

<style>
  [data-cep-field="cep"].is-invalid ~ [data-cep-feedback] {
  display: block !important;
}
    /* garante que a mensagem não seja cortada */
  #loginModal .input-wrapper { overflow: visible !important; }



  /* deixa o feedback bonitinho */
  #loginModal #passwordConfirmationFeedback{
    margin-top: .35rem;
    font-size: .875rem;
    color: #dc3545;
  }
    /* força a mensagem do invalid-feedback aparecer no seu tema */
  .invalid-feedback {
    display: none;
    font-size: .875rem;
    margin-top: .25rem;
    color: #dc3545;
  }

  /* mostra quando o input estiver inválido */
  #passwordConfirmation.is-invalid ~ #passwordConfirmationFeedback {
    display: block;
  }
  .placeholder-icon { pointer-events: auto; }
  .pass-toggle{
    background: transparent;
    border: 0;
    padding: 0;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }
.btn-terms-back{
  height: 42px; 
   padding: 0 16px;      
  line-height: 42px;   
}
  </style>
      </div>

    </div>
  </div>
</div>
<!-- Modal 2ª etapa: Completar perfil no cadastro -->
<div class="modal fade"
     id="registerProfileModal"
     tabindex="-1"
     aria-hidden="true"
     data-bs-backdrop="static"
     data-bs-keyboard="false">

  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Complete seu perfil</h5>
        <!-- Se você quiser impedir fechar, remova este botão -->
        <button type="button" class="btn-close" aria-label="Close" id="closeProfileModalBtn"></button>
      </div>

      <div class="modal-body">
        <p class="text-muted mb-3">
          Para concluir o cadastro, complete todas as informações abaixo.
        </p>

      <form id="registerProfileForm" method="POST" action="{{ route('registration.post') }}" data-cep-autofill>
        @csrf

          <div class="row g-3">

            <div class="col-12 col-md-6">
              <label class="form-label">Nome*</label>
              <input type="text" name="name" id="regProfileName" class="form-control" required>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Telefone*</label>
               <input
                type="text"
                name="phone"
                class="form-control"
                required
                inputmode="tel"
                autocomplete="tel"
                placeholder="(00) 00000-0000"
                data-mask="phoneBR"
                required
              >
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">WhatsApp*</label>
              <input type="text"
              name="whatsapp"
              class="form-control"
              required
              inputmode="tel"
              autocomplete="tel"
              placeholder="(00) 00000-0000"
              data-mask="phoneBR" required>
            </div>

             <div class="col-12 col-md-6">
              <label class="form-label">CEP*</label>
              <input type="text" name="cep" class="form-control" required data-cep-field="cep" placeholder="00000-000">
              <div class="invalid-feedback" data-cep-feedback>CEP inválido.</div>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Estado*</label>
              @php
                $ufs = [
                  'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','DF'=>'Distrito Federal',
                  'ES'=>'Espírito Santo','GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
                  'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RJ'=>'Rio de Janeiro','RN'=>'Rio Grande do Norte',
                  'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','RR'=>'Roraima','SC'=>'Santa Catarina','SP'=>'São Paulo','SE'=>'Sergipe','TO'=>'Tocantins'
                ];
              @endphp
              <select name="state" id="regState" class="form-select" required data-cep-field="state">
                <option value="">Selecione</option>
                @foreach($ufs as $uf => $label)
                  <option value="{{ $uf }}">{{ $label }} ({{ $uf }})</option>
                @endforeach
              </select>
            </div>

           <div class="col-12 col-md-6">
            <label class="form-label">Cidade*</label>
            <input type="text" name="city" class="form-control" required data-cep-field="city">
          </div>

            <div class="col-12">
            <label class="form-label">Endereço*</label>
            <input type="text" name="address" class="form-control" required data-cep-field="address">
          </div>

            <div class="col-12">
              <label class="form-label">Descrição*</label>
              <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

         
            <div class="col-12">
              <label class="form-label">Especialidades*</label>
              <br>
              <small class="text-muted">Dica: segure Ctrl (Windows) / Cmd (Mac) para selecionar várias.</small>
              <select name="specialties[]" class="form-select" multiple required style="min-height: 180px;">
                @foreach(($specialties ?? []) as $spec)
                  <option value="{{ $spec->id }}">{{ $spec->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-12 d-flex gap-2 justify-content-end mt-2">
          
              <button type="submit" class="ht-btn">
                Concluir cadastro
              </button>
            </div>

          </div>
        </form>

        <div id="regProfileMsg" class="mt-3"></div>
      </div>

    </div>
  </div>
</div>

<!-- Modal: Solicitar código de verificação de e-mail -->
<div class="modal fade" id="verifyEmailRequestModal" tabindex="-1" aria-labelledby="verifyEmailRequestLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="user-data-form modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="form-wrapper m-auto">
        <div class="text-center mb-20">
          <h2 id="verifyEmailRequestLabel">Verificar e-mail</h2>
          <p>Informe seu e-mail para enviarmos um código de verificação.</p>
        </div>

        <form id="verifyEmailRequestForm">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-wrapper position-relative mb-25">
                <label>E-mail*</label>
                <input type="email" name="email" id="verifyEmailRequestEmail" placeholder="seu_email@gmail.com" required>
              </div>
            </div>

            <div class="col-12">
              <button type="button" class="btn-four w-100 tran3s d-block mt-10" id="sendVerifyCodeBtn">
                Enviar código
              </button>
            </div>

            <div class="col-12 text-center mt-3">
              <button type="button" class="btn btn-link p-0" id="backToLoginFromVerifyReqBtn">
                Voltar para o login
              </button>
            </div>
          </div>
        </form>

        <div id="verifyEmailRequestMsg" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Confirmar código de verificação -->
<div class="modal fade" id="verifyEmailCodeModal" tabindex="-1" aria-labelledby="verifyEmailCodeLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="user-data-form modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="form-wrapper m-auto">
        <div class="text-center mb-20">
          <h2 id="verifyEmailCodeLabel">Confirmar código</h2>
          <p class="mb-1">Digite o código que enviamos para:</p>
          <strong id="verifyEmailCodeTo"></strong>
        </div>

        <form id="verifyEmailCodeForm">
          @csrf
          <input type="hidden" id="verifyEmailHiddenEmail" name="email">

          <div class="row">
            <div class="col-12">
              <div class="input-wrapper position-relative mb-25">
                <label>Código*</label>
                <input
                  type="text"
                  name="token"
                  id="verifyEmailToken"
                  placeholder="Ex.: 123456"
                  inputmode="numeric"
                  maxlength="6"
                  required
                >
              </div>
            </div>

            <div class="col-12">
              <button type="button" class="btn-four w-100 tran3s d-block mt-10" id="confirmVerifyCodeBtn">
                Confirmar
              </button>
            </div>

            <div class="col-12 d-flex justify-content-between mt-3">
              <button type="button" class="btn btn-link p-0" id="resendVerifyCodeBtn">
                Reenviar código
              </button>

              <button type="button" class="btn btn-link p-0" id="changeVerifyEmailBtn">
                Alterar e-mail
              </button>
            </div>
          </div>
        </form>

        <div id="verifyEmailCodeMsg" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="container">
            <div class="user-data-form modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="form-wrapper m-auto">
                    <ul class="nav nav-tabs border-0 w-100" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#fc1"
                                role="tab" aria-selected="true">Entrar</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#fc2" role="tab"
                                aria-selected="false" tabindex="-1">Cadastrar</button>
                        </li>
                    </ul>
                    <div class="tab-content mt-30">
                        <!-- Login Tab -->
                        <div class="tab-pane show active" role="tabpanel" id="fc1">
                            <div class="text-center mb-20">
                                <h2>Olá, seja bem-vindo!</h2>
                                <p>Você ainda não tem uma conta?
                              <a href="#" class="js-switch-tab" data-tab="fc2">Inscreva-se</a>
                            </p>

                            </div>
                            <form id="loginForm" method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-wrapper position-relative mb-25">
                                            <label>Email*</label>
                                            <input type="email" name="email" placeholder="meu_email@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-wrapper position-relative mb-20">
                                            <label>Senha*</label>

                                            <input type="password" name="password" placeholder="Digite aqui sua senha" required>

                                            <span class="placeholder-icon">
                                              <button type="button" class="pass-toggle" aria-label="Exibir/ocultar senha">
                                                <img src="{{ asset('assets/img/icon/icon-44.svg') }}" alt="icon">
                                              </button>
                                            </span>
                                          </div>
                                        <div id="loginMsg"></div>
                                    </div>
                                   <div class="col-12 text-start mb-2">
                               <button type="button" class="btn btn-link p-0" id="openForgotBtn">
                                  Esqueceu a senha?
                                </button>
                                    <div class="col-12 text-start mb-2">
                                <button type="button" class="btn btn-link p-0" id="openVerifyEmailBtn">
                                  Verificar e-mail / Liberar acesso
                                </button>
                                  </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="agreement-checkbox d-flex justify-content-between align-items-center my-1">
                                            <div>
                                                <input type="checkbox" id="remember" name="remember">
                                                <label for="remember">Mantenha-me conectado</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="ht-btn w-100 d-block mt-20">Entrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                          <!-- Modal 1: Solicitar envio do código -->
<div class="modal fade" id="verifyEmailRequestModal" tabindex="-1" aria-labelledby="verifyEmailRequestLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="user-data-form modal-content">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      <div class="form-wrapper m-auto">
        <div class="text-center mb-20">
          <h2 id="verifyEmailRequestLabel">Verificar e-mail</h2>
          <p>Informe seu e-mail para enviarmos o código de verificação.</p>
        </div>

        <form id="verifyEmailRequestForm">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="input-wrapper position-relative mb-25">
                <label>E-mail*</label>
                <input type="email" name="email" id="verifyEmailRequestEmail" placeholder="seu_email@gmail.com" required>
              </div>
            </div>

            <div class="col-12">
              <button type="button" class="btn-four w-100 tran3s d-block mt-20" id="sendVerifyCodeBtn">
                Enviar código
              </button>
            </div>

            <div class="col-12 text-center mt-3">
              <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                Voltar para o login
              </button>
            </div>
          </div>
        </form>

        <div id="verifyEmailRequestMsg" class="mt-3"></div>
      </div>
    </div>
  </div>
</div>

              <!-- Modal 2: Confirmar código -->
              <div class="modal fade" id="verifyEmailCodeModal" tabindex="-1" aria-labelledby="verifyEmailCodeLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="user-data-form modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="form-wrapper m-auto">
                      <div class="text-center mb-20">
                        <h2 id="verifyEmailCodeLabel">Confirmar código</h2>
                        <p class="mb-1">Digite o código enviado para:</p>
                        <strong id="verifyEmailCodeTo"></strong>
                      </div>

                      <form id="verifyEmailCodeForm">
                        @csrf
                        <input type="hidden" id="verifyEmailHiddenEmail" name="email">

                        <div class="row">
                          <div class="col-12">
                            <div class="input-wrapper position-relative mb-25">
                              <label>Código*</label>
                              <input type="text" name="token" id="verifyEmailToken" placeholder="Ex.: 123456"
                                    inputmode="numeric" maxlength="6" required>
                            </div>
                            <small class="text-muted">O código expira em 15 minutos.</small>
                          </div>

                          <div class="col-12">
                            <button type="button" class="btn-four w-100 tran3s d-block mt-20" id="confirmVerifyCodeBtn">
                              Confirmar
                            </button>
                          </div>

                          <div class="col-12 d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-link p-0" id="resendVerifyCodeBtn">Reenviar</button>
                            <button type="button" class="btn btn-link p-0" id="changeVerifyEmailBtn">Alterar e-mail</button>
                          </div>

                          <div class="col-12 text-center mt-3">
                            <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                              Voltar para o login
                            </button>
                          </div>
                        </div>
                      </form>

                      <div id="verifyEmailCodeMsg" class="mt-3"></div>
                    </div>
                  </div>
                </div>
              </div>


                        <!-- Register Tab -->
                        <div class="tab-pane" role="tabpanel" id="fc2">
                            <div class="text-center mb-20">
                                <h2>Cadastrar na Vila Contábil</h2>
                                <p>Você já possui uma conta?
                                <a href="#" class="js-switch-tab" data-tab="fc1">Entrar</a>
                              </p>
                            </div>
                            <form id="registrationForm" method="POST" action="{{ route('registration.post') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-wrapper position-relative mb-25">
                                            <label>Nome*</label>
                                            <input type="text" name="name" placeholder="Nome Completo" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-wrapper position-relative mb-25">
                                            <label>E-mail*</label>
                                            <input type="email" name="email" placeholder="seu_email@gmail.com" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="input-wrapper position-relative mb-20">
                                 <div class="input-wrapper position-relative mb-20">
                                  <label>Senha*</label>

                                  <input type="password" name="password" placeholder="Digite aqui sua senha" required>

                                  <span class="placeholder-icon">
                                    <button type="button" class="pass-toggle" aria-label="Exibir/ocultar senha">
                                      <img src="{{ asset('assets/img/icon/icon-44.svg') }}" alt="icon">
                                    </button>
                                  </span>
                                </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="input-wrapper position-relative mb-20">
                                          <label>Confirmar Senha**</label>

                                          <input
                                          class="form-control"
                                            type="password"
                                            name="password_confirmation"
                                            id="passwordConfirmation"
                                            placeholder="Confirme sua senha"
                                            required

                                          >

                                          <div class="invalid-feedback" id="passwordConfirmationFeedback">
                                            As senhas não conferem.
                                          </div>

                                          <span class="placeholder-icon">
                                            <button type="button" class="pass-toggle" aria-label="Exibir/ocultar senha">
                                              <img src="{{ asset('assets/img/icon/icon-44.svg') }}" alt="icon">
                                            </button>
                                          </span>
                                        </div>
                                      </div>                             
                                    </div>
                                   
                                    <div class="col-12">
                                        <div class="agreement-checkbox d-flex justify-content-between align-items-start my-3">
                                            <input type="checkbox" id="remember2" name="terms"  value="1" required>
                                            <label for="remember2">
                                                Ao clicar no botão "Registrar", você concorda com os
                                                <a href="#" class="open-terms">Termos e Condições</a>
                                                <a href="#" class="open-terms">Política de Privacidade</a>
                                            </label>



                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="ht-btn w-100 d-block mt-20">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                            <div id="registerMsg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Recuperação de Senha -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="user-data-form modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="form-wrapper m-auto">
                <div class="text-center mb-20">
                    <h2 id="forgotPasswordLabel">Recuperar senha</h2>
                    <p>Informe o e-mail cadastrado para enviarmos um link de recuperação.</p>
                </div>

                <form id="forgotPasswordForm" method="POST" action="{{ route('password.forgot') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-wrapper position-relative mb-25">
                                <label>E-mail*</label>
                                <input type="email" name="email" id="forgotEmail" placeholder="seu_email@gmail.com" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="button" class="btn-four w-100 tran3s d-block mt-20" id="sendResetBtn">
                                Enviar link de recuperação
                            </button>
                        </div>

                        <div class="col-12 text-center mt-3">
                            <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal">
                                Voltar para o login
                            </button>
                        </div>
                    </div>
                </form>

                <div id="forgotPasswordMsg" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
/** ========= Máscaras (BR) ========= */
function formatPhoneBR(value) {
  const digits = (value || "").replace(/\D/g, "").slice(0, 11);

  if (!digits) return "";

  const ddd = digits.slice(0, 2);
  const rest = digits.slice(2);

  // 11 dígitos = celular (9xxxx-xxxx), 10 = fixo (xxxx-xxxx)
  const isMobile = digits.length > 10;
  const part1Len = isMobile ? 5 : 4;

  const p1 = rest.slice(0, part1Len);
  const p2 = rest.slice(part1Len, part1Len + 4);

  let out = "";
  if (ddd.length) out += `(${ddd}`;
  if (ddd.length === 2) out += ") ";
  if (p1.length) out += p1;
  if (p2.length) out += `-${p2}`;

  return out;
}

function bindPhoneMask(input) {
  if (!input || input.dataset.maskBound === "1") return;
  input.dataset.maskBound = "1";

  const apply = () => {
    const formatted = formatPhoneBR(input.value);
    input.value = formatted;
  };

  input.addEventListener("input", apply);
  input.addEventListener("blur", apply);

  // aplica já na carga (caso venha preenchido)
  apply();
}

function initInputMasks(container = document) {
  container.querySelectorAll('input[data-mask="phoneBR"]').forEach(bindPhoneMask);
}
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {

initInputMasks(document);

 // ========= CEP Autofill "Component" =========
function initCepAutofill(formEl) {
  const cepEl = formEl.querySelector('[data-cep-field="cep"]');
  const stateEl = formEl.querySelector('[data-cep-field="state"]');
  const cityEl = formEl.querySelector('[data-cep-field="city"]');
  const addressEl = formEl.querySelector('[data-cep-field="address"]');
  const neighborhoodEl = formEl.querySelector('[data-cep-field="neighborhood"]');
  const feedbackEl = formEl.querySelector('[data-cep-feedback]');

  if (!cepEl) return;

  let timer = null;
  let lastCep = null;
  let lastData = null;
  let controller = null;

  const onlyDigits = (s) => (s || "").replace(/\D/g, "");
  const formatCep = (v) => {
    const d = onlyDigits(v).slice(0, 8);
    return d.length > 5 ? `${d.slice(0, 5)}-${d.slice(5)}` : d;
  };

  const setLoading = (on) => {
    // não bloqueio city/address (pq pode ter tema/UX), mas você pode travar se quiser
    if (stateEl) stateEl.disabled = !!on; // select melhor desabilitar
  };

  const setValid = () => {
    cepEl.classList.remove("is-invalid");
    cepEl.classList.add("is-valid");
    cepEl.setCustomValidity("");
    if (feedbackEl) feedbackEl.textContent = "";
  };

  const setInvalid = (msg) => {
    cepEl.classList.remove("is-valid");
    cepEl.classList.add("is-invalid");
    cepEl.setCustomValidity(msg || "CEP inválido.");
    if (feedbackEl) feedbackEl.textContent = msg || "CEP inválido.";
  };

  const applyData = (data) => {
    if (stateEl && data.uf) stateEl.value = data.uf;
    if (cityEl) cityEl.value = data.localidade || "";
    if (addressEl) addressEl.value = data.logradouro || "";
    if (neighborhoodEl) neighborhoodEl.value = data.bairro || "";
  };

  const lookup = async () => {
    const cepDigits = onlyDigits(cepEl.value);

    // limpa estados visuais enquanto digita
    cepEl.classList.remove("is-valid", "is-invalid");
    cepEl.setCustomValidity("");
    if (feedbackEl) feedbackEl.textContent = "";

    if (cepDigits.length !== 8) return;

    // cache simples (evita request repetido se usuário sai/volta)
    if (cepDigits === lastCep && lastData) {
      applyData(lastData);
      setValid();
      return;
    }

    // cancela request anterior
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
      if (err.name === "AbortError") return; // usuário continuou digitando
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

  // se colar/editar e sair
  cepEl.addEventListener("blur", lookup);
}

// Auto-init: qualquer form com data-cep-autofill vira "componente"
document.querySelectorAll("[data-cep-autofill]").forEach(initCepAutofill);

    // Toggle mostrar/ocultar senha (delegação funciona mesmo em modal)
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.pass-toggle');
    if (!btn) return;

    const wrapper = btn.closest('.input-wrapper');
    if (!wrapper) return;

    const input = wrapper.querySelector('input[type="password"], input[type="text"]');
    if (!input) return;

    input.type = (input.type === 'password') ? 'text' : 'password';
    btn.classList.toggle('is-visible', input.type === 'text');
  });

  const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

  // Helpers
  function switchTab(tabId) {
    const tabs = document.querySelectorAll('#loginModal .nav-link');
    const panes = document.querySelectorAll('#loginModal .tab-pane');

    tabs.forEach(tab => tab.classList.remove('active'));
    panes.forEach(pane => pane.classList.remove('show', 'active'));

    const btn = document.querySelector(`#loginModal [data-bs-target="#${tabId}"]`);
    const pane = document.getElementById(tabId);

    if (btn) btn.classList.add('active');
    if (pane) pane.classList.add('show', 'active');
  }

  // Links "Entrar / Inscreva-se" (sem onclick inline)
  document.querySelectorAll('.js-switch-tab').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      const tab = a.getAttribute('data-tab');
      if (tab) switchTab(tab);
    });
  });

  // Modais
  const loginEl  = document.getElementById('loginModal');
  const termsEl  = document.getElementById('termsModal');
  const profEl   = document.getElementById('registerProfileModal');
  const forgotEl = document.getElementById('forgotPasswordModal');

  const loginModal  = loginEl ? bootstrap.Modal.getOrCreateInstance(loginEl) : null;
  const termsModal  = termsEl ? bootstrap.Modal.getOrCreateInstance(termsEl) : null;
  const profModal   = profEl ? bootstrap.Modal.getOrCreateInstance(profEl, { backdrop: 'static', keyboard: false }) : null;
  const forgotModal = forgotEl ? bootstrap.Modal.getOrCreateInstance(forgotEl) : null;

  // Abrir termos/políticas (impede clicar e marcar/desmarcar checkbox por estar dentro do label)
  document.querySelectorAll('.open-terms').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation(); // evita toggle do checkbox (por estar dentro do label)

      // garante que quando voltar o login fique na aba "Cadastrar"
      switchTab('fc2');

      loginModal?.hide();
      setTimeout(() => termsModal?.show(), 200);
    });
  });

  // Voltar dos termos
  document.getElementById('backToRegisterBtn')?.addEventListener('click', () => {
    termsModal?.hide();
    setTimeout(() => {
      loginModal?.show();
      switchTab('fc2');
    }, 200);
  });

  // Abrir modal de recuperação de senha (controle via JS)
  document.getElementById('openForgotBtn')?.addEventListener('click', (e) => {
    e.preventDefault();
    loginModal?.hide();
    setTimeout(() => forgotModal?.show(), 150);
  });

  // Enviar link de recuperação (POST)
  document.getElementById('sendResetBtn')?.addEventListener('click', async () => {
    const email = document.getElementById('forgotEmail')?.value?.trim() || '';
    const msg = document.getElementById('forgotPasswordMsg');
    if (!msg) return;

    if (!email) {
      msg.innerHTML = '<div class="alert alert-danger">Informe seu e-mail.</div>';
      return;
    }

    msg.innerHTML = '<div class="alert alert-info">Enviando...</div>';

    try {
      const res = await fetch(@json(route('password.forgot')), {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({ email }),
        credentials: 'same-origin'
      });

      const data = await res.json().catch(() => ({}));

      if (!res.ok) throw new Error(data.message || 'Não foi possível enviar. Tente novamente.');

      msg.innerHTML = '<div class="alert alert-success">' + (data.message || 'Se existir, enviamos um link.') + '</div>';
      setTimeout(() => forgotModal?.hide(), 1500);
    } catch (err) {
      msg.innerHTML = '<div class="alert alert-danger">' + (err.message || 'Não foi possível enviar. Tente novamente.') + '</div>';
    }
  });

  // LOGIN (AJAX)
  const loginForm = document.getElementById('loginForm');
  const loginMsg  = document.getElementById('loginMsg');

  if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (loginMsg) loginMsg.innerHTML = '';

      try {
        const res = await fetch(@json(route('login.post')), {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': csrf,
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: new FormData(loginForm),
          credentials: 'same-origin'
        });

        const data = await res.json().catch(() => ({}));

        if (!res.ok || !data.success) throw new Error(data.message || 'Falha ao realizar login.');

        if (loginMsg) {
          loginMsg.innerHTML = '<div class="alert alert-success">' + (data.message || 'Login realizado com sucesso!') + '</div>';
        }

        window.location.href = data.redirect || '/painel';
      } catch (err) {
        if (loginMsg) {
          loginMsg.innerHTML = '<div class="alert alert-danger">' + (err.message || 'Erro ao realizar login.') + '</div>';
        }
      }
    });
  }

// CADASTRO EM 2 ETAPAS
const regForm      = document.getElementById('registrationForm');
const profForm     = document.getElementById('registerProfileForm');
const regMsg       = document.getElementById('registerMsg');
const profMsg      = document.getElementById('regProfileMsg');
const profNameInp  = document.getElementById('regProfileName');
const closeProfBtn = document.getElementById('closeProfileModalBtn');

function showRegError(html) {
  if (regMsg) regMsg.innerHTML = html;
}

function validatePasswords(showUI = false) {
  if (!regForm) return true;

  const pwd  = regForm.querySelector('input[name="password"]');
  const conf = regForm.querySelector('input[name="password_confirmation"]');

  const feedback = document.getElementById('passwordConfirmationFeedback');

  if (!pwd || !conf) return true;

  // helper visual
  const setInvalid = (msg) => {
    conf.setCustomValidity(msg || '');
    conf.classList.add('is-invalid');
    conf.classList.remove('is-valid');
    if (feedback) feedback.textContent = msg || 'As senhas não conferem.';
  };

  const setValid = () => {
    conf.setCustomValidity('');
    conf.classList.remove('is-invalid');
    conf.classList.add('is-valid');
    if (feedback) feedback.textContent = '';
  };

  // se o campo ainda não foi preenchido, não marca como inválido
  if (!pwd.value || !conf.value) {
    conf.classList.remove('is-invalid', 'is-valid');
    conf.setCustomValidity('');
    if (feedback) feedback.textContent = '';
    return true;
  }

  const ok = pwd.value === conf.value;

  if (!ok) {
    setInvalid('As senhas não conferem.');
    if (showUI) {
      showRegError('<div class="alert alert-danger">As senhas não conferem.</div>');
    }
    return false;
  }

  setValid();
  return true;
}


if (regForm) {
  const pwd  = regForm.querySelector('input[name="password"]');
  const conf = regForm.querySelector('input[name="password_confirmation"]');
  const regSubmitBtn = regForm.querySelector('button[type="submit"]');

  // UX: se o usuário digitar confirmação diferente, já bloqueia o botão (e força corrigir antes de seguir)
const refreshSubmitState = () => {
  if (!regSubmitBtn || !pwd || !conf) return;

  // atualiza feedback visual enquanto digita (sem alert)
  validatePasswords(false);

  const shouldBlock = (pwd.value && conf.value && pwd.value !== conf.value);
  regSubmitBtn.disabled = shouldBlock;

  if (!shouldBlock && regMsg) regMsg.innerHTML = '';
};

  pwd?.addEventListener('input', refreshSubmitState);
  conf?.addEventListener('input', refreshSubmitState);

  regForm.addEventListener('submit', (e) => {
    e.preventDefault();
    if (regMsg) regMsg.innerHTML = '';

    // valida campos required do HTML
    if (!regForm.reportValidity()) return;

    // valida senha x confirmação
    if (!validatePasswords(true)) return;

    // valida termos
    const terms = regForm.querySelector('input[name="terms"]');
    if (terms && !terms.checked) {
      showRegError('<div class="alert alert-danger">Você precisa aceitar os Termos e a Política.</div>');
      return;
    }

    // preenche nome no modal 2
    const nameFromReg = regForm.querySelector('input[name="name"]')?.value || '';
    if (profNameInp) profNameInp.value = nameFromReg;

    // só aqui abre o modal 2
    loginModal?.hide();
    setTimeout(() => profModal?.show(), 150);
  });
}

// fechar modal 2
closeProfBtn?.addEventListener('click', () => {
  profModal?.hide();
  setTimeout(() => { loginModal?.show(); switchTab('fc2'); }, 150);
});

// 2ª etapa: envia tudo junto
if (regForm && profForm) {
  profForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (profMsg) profMsg.innerHTML = '';

    // segurança extra: se senha divergir, nem deixa enviar (caso alguém altere via devtools)
    if (!validatePasswords(true)) {
      profModal?.hide();
      setTimeout(() => { loginModal?.show(); switchTab('fc2'); }, 150);
      return;
    }

    if (!profForm.reportValidity()) return;

    const fd = new FormData(regForm);

    // Usa o name do modal de perfil
    if (profNameInp) {
      fd.delete('name');
      fd.append('name', profNameInp.value);
    }

    const fd2 = new FormData(profForm);
    for (const [k, v] of fd2.entries()) {
      if (k === '_token') continue;
      fd.append(k, v);
    }

    try {
      const res = await fetch(@json(route('registration.post')), {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: fd,
        credentials: 'same-origin'
      });

      const data = await res.json().catch(() => ({}));

      // pega erros de validação do Laravel (422)
      if (res.status === 422 && data.errors) {
        const first = Object.values(data.errors).flat()[0] || 'Erro de validação.';
        throw new Error(first);
      }

      if (!res.ok || !data.success) {
        throw new Error(data.message || 'Erro ao cadastrar. Verifique os campos.');
      }

      window.location.href = data.redirect || '/painel';
    } catch (err) {
      if (profMsg) {
        profMsg.innerHTML = '<div class="alert alert-danger">' + (err.message || 'Falha ao enviar cadastro. Tente novamente.') + '</div>';
      }
    }
  });
}
});
</script>
@endpush

