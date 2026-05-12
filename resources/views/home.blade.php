@extends('layouts.app')

@section('content')

{{-- DESTINATIONS POPULAIRES --}}
<section class="py-5">
    <div class="d-flex align-items-end justify-content-between mb-4">
        <div>
            <p class="section-eyebrow">Explorer</p>
            <h2 class="section-title mb-0">Destinations populaires</h2>
        </div>
        <a href="{{ route('maisons.index') }}" class="btn-outline-custom" style="font-size:13px;">Voir toutes →</a>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-5">
        <a href="{{ route('maisons.index', ['ville' => 'Hammamet']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Hammamet
        </a>
        <a href="{{ route('maisons.index', ['ville' => 'Sidi Bou Said']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Sidi Bou Said
        </a>
        <a href="{{ route('maisons.index', ['ville' => 'Djerba']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Djerba
        </a>
        <a href="{{ route('maisons.index', ['ville' => 'Tunis']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1596178065887-1198b6148b2b?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Tunis
        </a>
        <a href="{{ route('maisons.index', ['ville' => 'Sousse']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Sousse
        </a>
        <a href="{{ route('maisons.index', ['ville' => 'Tozeur']) }}" class="dest-chip">
            <img src="https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=60&h=60&fit=crop" class="dest-icon" alt="">
            Tozeur
        </a>
    </div>

    {{-- FEATURED MAISONS --}}
    <div class="d-flex align-items-end justify-content-between mb-4">
        <div>
            <p class="section-eyebrow">Sélection</p>
            <h2 class="section-title mb-0">Maisons à la une</h2>
        </div>
    </div>

    <div class="row g-4">
        @foreach($maisons as $maison)
        <div class="col-md-6 col-lg-4 fade-up fade-up-{{ ($loop->index % 3) + 1 }}">
            <div class="maison-card">
                <div class="card-img-wrap">
                    @if($maison->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($maison->image))
                        <img src="{{ asset('storage/' . $maison->image) }}" alt="{{ $maison->nom }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&h=440&fit=crop" alt="{{ $maison->nom }}">
                    @endif
                    <div class="card-img-overlay-grad"></div>
                    <div class="card-location-badge">
                        <i class="bi bi-geo-alt-fill"></i> {{ $maison->ville->nom ?? 'Tunisie' }}
                    </div>
                    @if($loop->first)
                        <div class="badge-new">Coup de cœur</div>
                    @endif
                    @auth
                    <form method="POST" action="{{ route('favoris.toggle', $maison->id) }}">
                        @csrf
                        <button type="submit" class="fav-btn">
                            <i class="bi {{ auth()->user()->hasFavorited($maison) ? 'bi-heart-fill text-danger' : 'bi-heart' }}" style="color:#888;"></i>
                        </button>
                    </form>
                    @endauth
                </div>
                <div class="card-body-custom">
                    <h3 class="card-maison-name">{{ $maison->nom }}</h3>
                    <div class="card-amenities">
                        <span class="amenity-tag"><i class="bi bi-door-open me-1"></i>{{ $maison->chambres->count() }} ch.</span>
                        <span class="amenity-tag"><i class="bi bi-wifi me-1"></i>Wifi</span>
                        <span class="amenity-tag"><i class="bi bi-shield-check me-1"></i>Vérifié</span>
                    </div>
                    <div class="card-footer-custom">
                        <div>
                            <div class="card-price">{{ $maison->chambres->min('prix') ?? '—' }} DT <span>/ nuit</span></div>
                            <div class="card-rating mt-1">
                                <i class="bi bi-star-fill" style="color:#E8A838; font-size:11px;"></i>
                                <strong>4.8</strong> <span style="color:#aaa;">(12 avis)</span>
                            </div>
                        </div>
                        <a href="{{ route('maisons.show', $maison->id) }}" class="btn-card">Voir →</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('maisons.index') }}" class="btn-primary-custom">
            <i class="bi bi-grid"></i> Voir toutes les maisons
        </a>
    </div>
</section>

{{-- WHY US --}}
<section class="py-5 mt-3" style="background: var(--white); border-radius: 20px; padding: 48px 40px !important;">
    <div class="text-center mb-5">
        <p class="section-eyebrow">Pourquoi nous choisir</p>
        <h2 class="section-title">Une expérience d'exception</h2>
    </div>
    <div class="row g-4">
        <div class="col-md-3 col-6">
            <div class="why-card text-center">
                <div class="why-icon mx-auto"><i class="bi bi-shield-check"></i></div>
                <strong style="font-size:14px;">Maisons vérifiées</strong>
                <p style="font-size:12px; color:#888; margin-top:6px;">Chaque propriété est contrôlée avant publication.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card text-center">
                <div class="why-icon mx-auto"><i class="bi bi-calendar-check"></i></div>
                <strong style="font-size:14px;">Réservation facile</strong>
                <p style="font-size:12px; color:#888; margin-top:6px;">Réservez en quelques clics, confirmation immédiate.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card text-center">
                <div class="why-icon mx-auto"><i class="bi bi-headset"></i></div>
                <strong style="font-size:14px;">Support 7j/7</strong>
                <p style="font-size:12px; color:#888; margin-top:6px;">Notre équipe est disponible à tout moment.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="why-card text-center">
                <div class="why-icon mx-auto"><i class="bi bi-arrow-counterclockwise"></i></div>
                <strong style="font-size:14px;">Annulation flexible</strong>
                <p style="font-size:12px; color:#888; margin-top:6px;">Annulation gratuite jusqu'à 48h avant.</p>
            </div>
        </div>
    </div>
</section>

@endsection