@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <h2 class="form-section-title">Mot de passe oublié ?</h2>
                <p style="font-size: 14px; color: #888;">Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label-custom">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="votre@email.com" class="form-control-custom">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="bi bi-send"></i> Envoyer le lien
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" style="color: var(--ink-soft); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="bi bi-arrow-left"></i> Retour à la connexion
                </a>
            </div>
        </div>
    </div>
</div>
@endsection