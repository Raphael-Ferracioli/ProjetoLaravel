@extends('layouts.app')

@section('title', 'Completar Perfil')

@section('content')
<div class="modal fade" id="completeProfileModal" tabindex="-1" aria-labelledby="completeProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="completeProfileModalLabel">Complete seu perfil</h5>
      </div>
      <div class="modal-body">
        <form action="{{ route('save.profile') }}" method="POST" id="completeProfileForm">
          @csrf
          <div class="row">
            <!-- Campos do perfil -->
            <div class="col-12 mb-3">
              <label for="description" class="form-label">Descrição Profissional</label>
              <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="col-6 mb-3">
              <label for="phone" class="form-label">Telefone</label>
              <input type="text" name="phone" id="phone" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
              <label for="whatsapp" class="form-label">WhatsApp</label>
              <input type="text" name="whatsapp" id="whatsapp" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
              <label for="cep" class="form-label">CEP</label>
              <input type="text" name="cep" id="cep" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
              <label for="city" class="form-label">Cidade</label>
              <input type="text" name="city" id="city" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
              <label for="state" class="form-label">Estado</label>
              <input type="text" name="state" id="state" class="form-control" required>
            </div>

            <div class="col-6 mb-3">
              <label for="address" class="form-label">Endereço</label>
              <input type="text" name="address" id="address" class="form-control" required>
            </div>

            <div class="col-12 mb-3">
              <label for="specialties" class="form-label">Especialidades</label>
              <select name="specialties[]" id="specialties" class="form-control" multiple required>
                @foreach($specialties as $specialty)
                  <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar e Continuar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Exibe o modal de preenchimento do perfil automaticamente
  document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('completeProfileModal'));
    modal.show();
  });
</script>
@endpush
