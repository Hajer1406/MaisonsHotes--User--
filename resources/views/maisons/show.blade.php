@extends('layouts.app')

@section('content')
<div class="py-4">

    {{-- BREADCRUMB --}}
    <nav style="font-size:13px; color:#888; margin-bottom:20px;">
        <a href="{{ route('home') }}" style="color:#888; text-decoration:none;">Accueil</a>
        <span style="margin:0 8px;">›</span>
        <a href="{{ route('maisons.index') }}" style="color:#888; text-decoration:none;">Maisons</a>
        <span style="margin:0 8px;">›</span>
        <span style="color:var(--ink);">{{ $maison->nom }}</span>
    </nav>

    @if(session('success'))
        <div class="alert-custom alert-success-custom mb-4">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-custom alert-danger-custom mb-4">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    {{-- GALERIE --}}
    @php
        $images = $maison->images ?? [];
        if (empty($images) && $maison->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($maison->image)) {
            $images = [$maison->image];
        }
    @endphp

    @if(count($images) > 0)
        <div id="maisonCarousel" class="carousel slide mb-5" data-bs-ride="carousel"
             style="border-radius:16px; overflow:hidden; box-shadow:0 12px 40px rgba(26,22,18,0.12);">
            <div class="carousel-inner">
                @foreach($images as $key => $img)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $img) }}" class="d-block w-100"
                             style="height:480px; object-fit:cover;" alt="{{ $maison->nom }}" loading="lazy">
                    </div>
                @endforeach
            </div>
            @if(count($images) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#maisonCarousel" data-bs-slide="prev"
                        style="width:50px; height:50px; background:rgba(26,22,18,0.6); border-radius:50%; top:50%; transform:translateY(-50%); left:16px;">
                    <i class="bi bi-chevron-left text-white"></i>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#maisonCarousel" data-bs-slide="next"
                        style="width:50px; height:50px; background:rgba(26,22,18,0.6); border-radius:50%; top:50%; transform:translateY(-50%); right:16px;">
                    <i class="bi bi-chevron-right text-white"></i>
                </button>
            @endif
        </div>
    @endif

    <div class="row g-4">
        {{-- LEFT COL --}}
        <div class="col-lg-8">

            {{-- MAISON HEADER --}}
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 style="font-family:'Cormorant Garamond',serif; font-size:38px; font-weight:400; color:var(--ink); margin-bottom:6px;">
                        {{ $maison->nom }}
                    </h1>
                    <p style="color:#888; font-size:14px;">
                        <i class="bi bi-geo-alt me-1" style="color:var(--clay);"></i>
                        {{ $maison->ville->nom ?? 'Tunisie' }}
                        @if($maison->adresse) — {{ $maison->adresse }} @endif
                    </p>
                </div>
                <span style="background:var(--mist); color:var(--ink-soft); font-size:13px; padding:6px 14px; border-radius:20px; white-space:nowrap;">
                    {{ $maison->chambres->count() }} chambre(s)
                </span>
            </div>

            {{-- DESCRIPTION --}}
            @if($maison->description)
            <div class="mb-5">
                <h3 style="font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:500; margin-bottom:12px;">Description</h3>
                <p style="color:var(--ink-soft); line-height:1.8; font-size:15px;">{{ $maison->description }}</p>
            </div>
            @endif

            <hr style="border:none; border-top:1px solid var(--mist); margin:32px 0;">

            {{-- CHAMBRES --}}
            <h2 style="font-family:'Cormorant Garamond',serif; font-size:28px; font-weight:400; margin-bottom:24px;">Chambres disponibles</h2>

            @forelse($maison->chambres as $chambre)
                <div class="mb-3" style="background:var(--white); border-radius:14px; border:1px solid rgba(196,149,106,0.12); overflow:hidden; transition:box-shadow 0.2s;"
                     onmouseover="this.style.boxShadow='0 8px 30px rgba(26,22,18,0.08)'" onmouseout="this.style.boxShadow='none'">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($chambre->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($chambre->image))
                                <img src="{{ asset('storage/' . $chambre->image) }}"
                                     style="width:100%; height:180px; object-fit:cover;" alt="{{ $chambre->type }}" loading="lazy">
                            @elseif($maison->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($maison->image))
                                <img src="{{ asset('storage/' . $maison->image) }}"
                                     style="width:100%; height:180px; object-fit:cover;" alt="{{ $chambre->type }}" loading="lazy">
                            @else
                                <div style="height:180px; background:var(--mist); display:flex; align-items:center; justify-content:center;">
                                    <i class="bi bi-door-open" style="font-size:32px; color:#ccc;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div style="padding:24px;">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h4 style="font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:500; margin-bottom:4px;">{{ $chambre->type }}</h4>
                                        <p style="font-size:13px; color:#888; margin-bottom:12px;">{{ $chambre->description ?: 'Chambre confortable et bien équipée.' }}</p>
                                    </div>
                                    @if($chambre->disponible)
                                        <span class="badge-status badge-available">Disponible</span>
                                    @else
                                        <span class="badge-status badge-unavailable">Indisponible</span>
                                    @endif
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <span style="font-family:'Cormorant Garamond',serif; font-size:26px; font-weight:600; color:var(--ink);">
                                            {{ number_format($chambre->prix, 0, ',', ' ') }} DT
                                        </span>
                                        <span style="font-size:12px; color:#aaa;"> / nuit</span>
                                    </div>

                                    @if($chambre->disponible)
                                        @auth
                                            <button type="button" class="btn-primary-custom"
                                                    data-bs-toggle="modal" data-bs-target="#reservModal{{ $chambre->id }}">
                                                <i class="bi bi-calendar-check"></i> Réserver
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="btn-primary-custom">
                                                <i class="bi bi-lock"></i> Se connecter pour réserver
                                            </a>
                                        @endauth
                                    @else
                                        <button class="btn-outline-custom" disabled style="opacity:0.5; cursor:not-allowed;">
                                            Indisponible
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL RESERVATION --}}
                @if($chambre->disponible)
                <div class="modal fade" id="reservModal{{ $chambre->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header-custom">
                                <h5 class="modal-title-custom">Réserver — {{ $chambre->type }}</h5>
                                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="modal"></button>
                            </div>
                            <form method="POST" action="{{ route('reservations.store') }}" id="reservForm{{ $chambre->id }}" data-chambre-id="{{ $chambre->id }}" data-chambre-prix="{{ $chambre->prix }}">
                                @csrf
                                <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">
                                <div class="modal-body-custom">
                                    <div class="row g-3 mb-3">
                                        <div class="col-6">
                                            <label class="form-label-custom">Date d'arrivée</label>
                                            <input type="date" name="date_debut" id="debut_{{ $chambre->id }}"
                                                   class="form-control-custom" required min="{{ date('Y-m-d') }}">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label-custom">Date de départ</label>
                                            <input type="date" name="date_fin" id="fin_{{ $chambre->id }}"
                                                   class="form-control-custom" required min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                                        </div>
                                    </div>

                                    <div style="background:#F9F5F0; border-radius:10px; padding:16px; font-size:14px;">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span style="color:#888;">Prix par nuit</span>
                                            <span>{{ number_format($chambre->prix, 0, ',', ' ') }} DT</span>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span style="font-weight:500;">Total estimé</span>
                                            <span style="font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:600; color:var(--clay);" id="total_{{ $chambre->id }}">— DT</span>
                                        </div>
                                    </div>

                                    <div id="err_{{ $chambre->id }}" class="alert-custom alert-danger-custom d-none mt-3" style="font-size:13px;"></div>
                                </div>
                                <div class="modal-footer-custom">
                                    <button type="button" class="btn-outline-custom" data-bs-dismiss="modal" style="font-size:13px;">Annuler</button>
                                    <button type="submit" class="btn-primary-custom">Confirmer la réservation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            @empty
                <div class="alert-custom alert-info-custom">
                    <i class="bi bi-info-circle me-2"></i>Aucune chambre disponible pour cette maison.
                </div>
            @endforelse

            {{-- AVIS --}}
            @if($maison->avis->count() > 0)
                <hr style="border:none; border-top:1px solid var(--mist); margin:40px 0;">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 style="font-family:'Cormorant Garamond',serif; font-size:28px; font-weight:400; margin:0;">Avis clients</h2>
                    @php $avgNote = $maison->avis->avg('note'); @endphp
                    <div style="display:flex; align-items:center; gap:8px; background:var(--white); border:1px solid rgba(196,149,106,0.15); padding:8px 16px; border-radius:20px;">
                        <i class="bi bi-star-fill" style="color:#E8A838; font-size:13px;"></i>
                        <strong>{{ number_format($avgNote, 1) }}</strong>
                        <span style="color:#888; font-size:13px;">({{ $maison->avis->count() }} avis)</span>
                    </div>
                </div>
                <div class="row g-3">
                    @foreach($maison->avis as $avis)
                        <div class="col-md-6">
                            <div style="background:var(--white); border:1px solid rgba(196,149,106,0.1); border-radius:12px; padding:20px; height:100%;">
                                <div style="display:flex; gap:2px; margin-bottom:10px;">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="bi bi-star{{ $i <= $avis->note ? '-fill' : '' }}"
                                           style="color:{{ $i <= $avis->note ? '#E8A838' : '#ddd' }}; font-size:13px;"></i>
                                    @endfor
                                </div>
                                <p style="font-size:14px; color:var(--ink-soft); font-style:italic; margin-bottom:12px;">"{{ $avis->commentaire }}"</p>
                                <div style="font-size:12px; color:#aaa;">
                                    — {{ $avis->user->name ?? 'Anonyme' }} · {{ $avis->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- RIGHT SIDEBAR --}}
        <div class="col-lg-4">
            <div class="sticky-sidebar">
                <div class="info-card mb-3">
                    <h5 style="font-family:'Cormorant Garamond',serif; font-size:18px; font-weight:500; margin-bottom:16px;">Informations</h5>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <div style="display:flex; justify-content:space-between; font-size:14px; padding-bottom:10px; border-bottom:1px solid var(--mist);">
                            <span style="color:#888;">Chambres totales</span>
                            <strong>{{ $maison->chambres->count() }}</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px; padding-bottom:10px; border-bottom:1px solid var(--mist);">
                            <span style="color:#888;">Disponibles</span>
                            <strong style="color:#1A7A42;">{{ $maison->chambres->where('disponible', 1)->count() }}</strong>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:14px;">
                            <span style="color:#888;">Prix à partir de</span>
                            <strong>{{ $maison->chambres->min('prix') ?? '—' }} DT / nuit</strong>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h5 style="font-family:'Cormorant Garamond',serif; font-size:18px; font-weight:500; margin-bottom:10px;">Politique d'annulation</h5>
                    <p style="font-size:13px; color:#888; line-height:1.7; margin:0;">
                        Annulation gratuite jusqu'à 48h avant la date d'arrivée. Au-delà, des frais peuvent s'appliquer.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form[data-chambre-id]').forEach(function(form) {
        var chambreId = form.dataset.chambreId;
        var prix = parseFloat(form.dataset.chambrePrix);
        var debut = document.getElementById('debut_' + chambreId);
        var fin = document.getElementById('fin_' + chambreId);
        var total = document.getElementById('total_' + chambreId);
        var err = document.getElementById('err_' + chambreId);

        if (!debut || !fin || !total || !err) return;

        function calc() {
            if (debut.value && fin.value) {
                var d = Math.ceil((new Date(fin.value) - new Date(debut.value)) / 86400000);
                total.textContent = d > 0 ? (d * prix).toLocaleString('fr-FR') + ' DT' : '— DT';
            }
        }

        debut.addEventListener('change', calc);
        fin.addEventListener('change', calc);

        form.addEventListener('submit', function(e) {
            err.classList.add('d-none');
            if (!debut.value || !fin.value) {
                err.textContent = 'Veuillez sélectionner vos dates.';
                err.classList.remove('d-none');
                e.preventDefault();
                return;
            }
            if (new Date(fin.value) <= new Date(debut.value)) {
                err.textContent = 'La date de départ doit être après la date d\'arrivée.';
                err.classList.remove('d-none');
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection