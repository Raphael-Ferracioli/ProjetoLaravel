@extends('layouts.app')

@section('title','Redefinir senha')

@section('content')
<section class="pt-140 pb-140 pt-lg-100 pb-lg-100">
  <div class="container" style="max-width:540px;">
    <h2 class="mb-3">Redefinir senha</h2>

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">

      <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input class="form-control" type="email" name="email" value="{{ $email }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Nova senha</label>
        <input class="form-control" type="password" name="password" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Confirmar senha</label>
        <input class="form-control" type="password" name="password_confirmation" required>
      </div>

      <button class="btn btn-primary w-100" type="submit">Salvar nova senha</button>
    </form>
  </div>
</section>
@endsection
