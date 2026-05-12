@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <h2 class="form-section-title">Réinitialiser le mot de passe</h2>
                <p style="font-size: 14px; color: #888;">Choisissez un nouveau mot de passe sécurisé pour votre compte.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" placeholder="votre@email.com" class="form-control-custom">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">Nouveau mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label-custom">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="bi bi-check-circle"></i> Enregistrer le mot de passe
                </button>
            </form>
        </div>
    </div>
</div>
@endsection