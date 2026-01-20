@php

  $prefix = $prefix ?? 'reg';

  $ufs = [
    'AC'=>'Acre','AL'=>'Alagoas','AP'=>'Amapá','AM'=>'Amazonas','BA'=>'Bahia','CE'=>'Ceará','DF'=>'Distrito Federal',
    'ES'=>'Espírito Santo','GO'=>'Goiás','MA'=>'Maranhão','MT'=>'Mato Grosso','MS'=>'Mato Grosso do Sul','MG'=>'Minas Gerais',
    'PA'=>'Pará','PB'=>'Paraíba','PR'=>'Paraná','PE'=>'Pernambuco','PI'=>'Piauí','RJ'=>'Rio de Janeiro','RN'=>'Rio Grande do Norte',
    'RS'=>'Rio Grande do Sul','RO'=>'Rondônia','RR'=>'Roraima','SC'=>'Santa Catarina','SP'=>'São Paulo','SE'=>'Sergipe','TO'=>'Tocantins'
  ];
@endphp

<div class="col-12">
  <h4 style="margin: 10px 0 10px;">Dados do perfil</h4>
</div>

<div class="col-12 col-md-6">
  <div class="input-wrapper position-relative mb-25">
    <label>Telefone*</label>
    <input type="text" name="phone" id="{{ $prefix }}Phone" required>
  </div>
</div>

<div class="col-12 col-md-6">
  <div class="input-wrapper position-relative mb-25">
    <label>WhatsApp*</label>
    <input type="text" name="whatsapp" id="{{ $prefix }}Whatsapp" required>
  </div>
</div>

<div class="col-12 col-md-4">
  <div class="input-wrapper position-relative mb-25">
    <label>CEP*</label>
    <input type="text" name="cep" id="{{ $prefix }}Cep" required placeholder="00000-000">
  </div>
</div>

<div class="col-12 col-md-4">
  <div class="input-wrapper position-relative mb-25">
    <label>Estado (UF)*</label>
    <select name="state" id="{{ $prefix }}State" class="form-select" required>
      <option value="">Selecione...</option>
      @foreach($ufs as $uf => $label)
        <option value="{{ $uf }}">{{ $label }} ({{ $uf }})</option>
      @endforeach
    </select>
  </div>
</div>

<div class="col-12 col-md-4">
  <div class="input-wrapper position-relative mb-25">
    <label>Cidade*</label>
    <input type="text" name="city" id="{{ $prefix }}City" required>
  </div>
</div>

<div class="col-12">
  <div class="input-wrapper position-relative mb-25">
    <label>Endereço*</label>
    <input type="text" name="address" id="{{ $prefix }}Address" required>
  </div>
</div>

<div class="col-12">
  <div class="input-wrapper position-relative mb-25">
    <label>Especialidades* (selecione pelo menos uma)</label>
    <select name="specialties[]" class="form-select" multiple required style="min-height: 180px;">
      @foreach(($specialties ?? collect()) as $spec)
        <option value="{{ $spec->id }}">{{ $spec->name }}</option>
      @endforeach
    </select>
    <small class="text-muted">Dica: segure Ctrl (Windows) / Cmd (Mac) para selecionar várias.</small>
  </div>
</div>

<div class="col-12">
  <div class="input-wrapper position-relative mb-25">
    <label>Descrição profissional*</label>
    <textarea name="description" class="form-control" rows="4" required></textarea>
  </div>
</div>
