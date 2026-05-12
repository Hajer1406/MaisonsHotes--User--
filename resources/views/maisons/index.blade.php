@extends('layouts.app')

@section('content')
<div class="py-4">

    {{-- PAGE HEADER --}}
    <div class="mb-4">
        <p class="section-eyebrow">Catalogue</p>
        <h1 class="section-title">Toutes nos maisons</h1>
    </div>

    {{-- FILTER BAR --}}
    <form method="GET" action="{{ route('maisons.index') }}" class="filter-bar">
        @if(request('ville'))
            <input type="hidden" name="ville" value="{{ request('ville') }}">
        @endif
        <div class="filter-field">
            <span class="filter-label">Ville</span>
            <select name="ville_id" class="form-control-custom">
                <option value="">Toutes les villes</option>
                @foreach($villes as $ville)
                    <option value="{{ $ville->id }}" {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
                        {{ $ville->nom }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="filter-field" style="max-width: 150px;">
            <span class="filter-label">Prix max (DT)</span>
            <input type="number" name="prix_max" class="form-control-custom" placeholder="Ex: 200" value="{{ request('prix_max') }}">
        </div>
        <div class="filter-field" style="max-width: 150px;">
            <span class="filter-label">Chambres min.</span>
            <select name="chambres_min" class="form-control-custom">
                <option value="">Peu importe</option>
                <option value="1" {{ request('chambres_min') == 1 ? 'selected' : '' }}>1+</option>
                <option value="2" {{ request('chambres_min') == 2 ? 'selected' : '' }}>2+</option>
                <option value="3" {{ request('chambres_min') == 3 ? 'selected' : '' }}>3+</option>
            </select>
        </div>
        <div style="display:flex; gap:8px; align-items:flex-end;">
            <button type="submit" class="btn-primary-custom" style="padding:11px 22px;">
                <i class="bi bi-funnel"></i> Filtrer
            </button>
            @if(request()->hasAny(['ville_id','prix_max','chambres_min']))
                <a href="{{ route('maisons.index') }}" class="btn-outline-custom" style="padding:10px 16px; font-size:13px;">
                    <i class="bi bi-x"></i> Réinitialiser
                </a>
            @endif
        </div>
    </form>

    {{-- RESULTS COUNT --}}
    <p style="font-size:13px; color:#888; margin-bottom:20px;">
        {{ $maisons->total() }} maison{{ $maisons->total() > 1 ? 's' : '' }} trouvée{{ $maisons->total() > 1 ? 's' : '' }}
    </p>

    {{-- CARDS GRID --}}
    @if($maisons->count() > 0)
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

                        @auth
                            @php
                                $favorited = auth()->user()->hasFavorited($maison);
                            @endphp
                            <form method="POST" action="{{ route('favoris.toggle', $maison->id) }}">
                                @csrf
                                <button type="submit" class="fav-btn">
                                    <i class="bi {{ $favorited ? 'bi-heart-fill text-red-600' : 'bi-heart text-slate-500' }}"></i>
                                </button>
                            </form>
                        @endauth
                    </div>

                    <div class="card-body-custom">
                        <h3 class="card-maison-name">{{ $maison->nom }}</h3>

                        <div class="card-amenities">
                            <span class="amenity-tag"><i class="bi bi-door-open me-1"></i>{{ $maison->chambres->count() }} chambre(s)</span>
                            <span class="amenity-tag"><i class="bi bi-check-circle me-1"></i>{{ $maison->chambres->where('disponible',1)->count() }} dispo.</span>
                        </div>

                        <div class="card-footer-custom">
                            <div>
                                <div class="card-price">
                                    {{ $maison->chambres->min('prix') ?? '—' }} DT
                                    <span>/ nuit</span>
                                </div>
                            </div>
                            <a href="{{ route('maisons.show', $maison->id) }}" class="btn-card">Voir →</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-5 d-flex justify-content-center">
            {{ $maisons->withQueryString()->links() }}
        </div>

    @else
        <div class="text-center py-5" style="background: var(--white); border-radius: 14px; border: 1px dashed rgba(196,149,106,0.3);">
            <i class="bi bi-house-slash" style="font-size:40px; color:var(--clay); opacity:0.5;"></i>
            <p style="margin-top:16px; color:#888;">Aucune maison ne correspond à vos critères.</p>
            <a href="{{ route('maisons.index') }}" class="btn-outline-custom mt-2 d-inline-block">Voir toutes les maisons</a>
        </div>
    @endif

</div>
@endsection