@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <h2 class="form-section-title">Espace client</h2>
                <p style="font-size: 14px; color: #888;">Connectez-vous pour accéder à vos séjours</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label-custom">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="votre@email.com" class="form-control-custom">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">Mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <label for="remember_me" class="d-flex align-items-center" style="cursor: pointer;">
                        <input id="remember_me" type="checkbox" name="remember" class="form-check-input me-2" style="cursor: pointer;">
                        <span style="font-size: 14px; color: var(--ink-soft);">Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size: 14px; color: var(--clay); text-decoration: none; font-weight: 500;">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                </button>
            </form>

            <div class="text-center mt-4" style="position: relative;">
                <div style="border-top: 1px solid var(--mist);"></div>
                <span style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--white); padding: 0 12px; font-size: 11px; color: #aaa; text-transform: uppercase; letter-spacing: 0.1em;">ou</span>
            </div>

            <div class="text-center mt-4">
                <p style="font-size: 14px; color: #888;">
                    Nouveau client ? 
                    <a href="{{ route('register') }}" style="color: var(--clay); text-decoration: none; font-weight: 500;">
                        Créer un compte
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection