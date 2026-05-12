@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="form-card">
            <div class="text-center mb-4">
                <div style="width: 60px; height: 60px; background: #FBF7F2; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                    <i class="bi bi-envelope-check" style="font-size: 28px; color: var(--clay);"></i>
                </div>
                <h2 class="form-section-title">Vérifiez votre email</h2>
                <p style="font-size: 14px; color: #888;">Merci de vous être inscrit sur Maison d'hôtes ! Un e-mail de vérification vous a été envoyé. Veuillez cliquer sur le lien qu'il contient pour activer votre compte.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert-custom alert-info-custom mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    Un nouveau lien de vérification a été envoyé à l'adresse e-mail associée à votre compte.
                </div>
            @endif

            <div class="d-flex flex-column gap-3">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn-primary-custom w-100">
                        <i class="bi bi-send"></i> Renvoyer l'email
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-outline-custom w-100">
                        <i class="bi bi-box-arrow-right"></i> Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection