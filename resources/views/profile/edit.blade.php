@extends('layouts.app')

@section('content')
<div class="py-4">

    <div class="mb-5">
        <p class="section-eyebrow">Compte</p>
        <h1 class="section-title">Mon profil</h1>
    </div>

    <div class="row g-4">

        {{-- SIDEBAR NAV --}}
        <div class="col-lg-3">
            <div class="info-card" style="padding:8px;">
                @php
                    $section = request('section', 'info');
                @endphp
                <nav style="display:flex; flex-direction:column; gap:2px;">
                    <a href="?section=info"
                       style="padding:11px 16px; border-radius:9px; font-size:14px; text-decoration:none; display:flex; align-items:center; gap:10px;
                              color:{{ $section === 'info' ? 'var(--clay)' : 'var(--ink-soft)' }};
                              background:{{ $section === 'info' ? '#FBF7F2' : 'transparent' }};">
                        <i class="bi bi-person"></i> Informations
                    </a>
                    <a href="?section=password"
                       style="padding:11px 16px; border-radius:9px; font-size:14px; text-decoration:none; display:flex; align-items:center; gap:10px;
                              color:{{ $section === 'password' ? 'var(--clay)' : 'var(--ink-soft)' }};
                              background:{{ $section === 'password' ? '#FBF7F2' : 'transparent' }};">
                        <i class="bi bi-shield-lock"></i> Mot de passe
                    </a>
                    <a href="?section=delete"
                       style="padding:11px 16px; border-radius:9px; font-size:14px; text-decoration:none; display:flex; align-items:center; gap:10px;
                              color:{{ $section === 'delete' ? '#C0392B' : '#aaa' }};
                              background:{{ $section === 'delete' ? '#FEF0EE' : 'transparent' }};">
                        <i class="bi bi-trash"></i> Supprimer le compte
                    </a>
                </nav>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-lg-9">

            {{-- INFOS PERSONNELLES --}}
            @if($section === 'info' || !request('section'))
            <div class="form-card">
                <h3 class="form-section-title">Informations personnelles</h3>
                <p class="form-section-sub">Mettez à jour vos informations de compte.</p>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="form-label-custom">Nom complet</label>
                        <input type="text" name="name" class="form-control-custom @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p style="color:#C0392B; font-size:12px; margin-top:5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Adresse email</label>
                        <input type="email" name="email" class="form-control-custom @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p style="color:#C0392B; font-size:12px; margin-top:5px;">{{ $message }}</p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <p style="font-size:12px; color:#E8A838; margin-top:8px;">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                Email non vérifié.
                                <button form="send-verification" class="btn-outline-custom" style="font-size:12px; padding:4px 12px; margin-left:8px;">
                                    Renvoyer l'email
                                </button>
                            </p>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check2"></i> Enregistrer
                        </button>
                        @if(session('status') === 'profile-updated')
                            <span style="font-size:13px; color:#1A7A42;"><i class="bi bi-check-circle me-1"></i>Modifications enregistrées !</span>
                        @endif
                    </div>
                </form>

                <form id="send-verification" method="POST" action="{{ route('verification.send') }}">@csrf</form>
            </div>
            @endif

            {{-- MOT DE PASSE --}}
            @if($section === 'password')
            <div class="form-card">
                <h3 class="form-section-title">Changer le mot de passe</h3>
                <p class="form-section-sub">Utilisez un mot de passe long et aléatoire pour sécuriser votre compte.</p>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label-custom">Mot de passe actuel</label>
                        <input type="password" name="current_password" class="form-control-custom" required>
                        @error('current_password', 'updatePassword')
                            <p style="color:#C0392B; font-size:12px; margin-top:5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Nouveau mot de passe</label>
                        <input type="password" name="password" class="form-control-custom" required>
                        @error('password', 'updatePassword')
                            <p style="color:#C0392B; font-size:12px; margin-top:5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation" class="form-control-custom" required>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-shield-check"></i> Mettre à jour
                        </button>
                        @if(session('status') === 'password-updated')
                            <span style="font-size:13px; color:#1A7A42;"><i class="bi bi-check-circle me-1"></i>Mot de passe mis à jour !</span>
                        @endif
                    </div>
                </form>
            </div>
            @endif

            {{-- SUPPRIMER COMPTE --}}
            @if($section === 'delete')
            <div class="form-card" style="border-color:rgba(192,57,43,0.15);">
                <h3 class="form-section-title" style="color:#C0392B;">Supprimer le compte</h3>
                <p class="form-section-sub">Cette action est irréversible. Toutes vos données seront définitivement supprimées.</p>

                <div style="background:#FEF0EE; border-radius:10px; padding:16px; margin-bottom:24px; font-size:14px; color:#8B2020;">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Vos réservations, avis et favoris seront supprimés définitivement.
                </div>

                <form method="POST" action="{{ route('profile.destroy') }}"
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4">
                        <label class="form-label-custom">Confirmez votre mot de passe</label>
                        <input type="password" name="password" class="form-control-custom" required>
                        @error('password', 'userDeletion')
                            <p style="color:#C0392B; font-size:12px; margin-top:5px;">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn-danger-custom" style="padding:11px 24px; font-size:14px;">
                        <i class="bi bi-trash3 me-1"></i> Supprimer définitivement mon compte
                    </button>
                </form>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection