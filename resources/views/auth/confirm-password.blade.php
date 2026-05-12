@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <div style="width: 60px; height: 60px; background: #FBF7F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <i class="bi bi-shield-lock" style="font-size: 28px; color: var(--clay);"></i>
                </div>
                <h2 class="form-section-title">Zone sécurisée</h2>
                <p style="font-size: 14px; color: #888;">Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.</p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <label for="password" class="form-label-custom">Mot de passe</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="form-control-custom">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button type="submit" class="btn-primary-custom w-100">
                    <i class="bi bi-check-circle"></i> Confirmer
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="javascript:history.back()" style="color: var(--ink-soft); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
            </div>
        </div>
    </div>
</div>
@endsection