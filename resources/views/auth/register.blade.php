@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <h2 class="form-section-title">Inscription</h2>
                <p style="font-size: 14px; color: #888;">Créez votre compte pour réserver votre prochain séjour</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label-custom">Nom complet</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Jean Dupont" class="form-control-custom">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="votre@email.com" class="form-control-custom">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">Mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label-custom">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="bi bi-person-plus"></i> S'inscrire
                </button>
            </form>

            <div class="text-center mt-4" style="position: relative;">
                <div style="border-top: 1px solid var(--mist);"></div>
                <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--white); padding: 0 12px; font-size: 11px; color: #aaa; text-transform: uppercase; letter-spacing: 0.1em;">ou</span>
            </div>

            <div class="text-center mt-4">
                <p style="font-size: 14px; color: #888;">
                    Déjà inscrit ? 
                    <a href="{{ route('login') }}" style="color: var(--clay); text-decoration: none; font-weight: 500;">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection