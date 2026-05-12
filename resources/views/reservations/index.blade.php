@extends('layouts.app')

@section('content')
<div class="py-4">

    <div class="mb-5">
        <p class="section-eyebrow">Espace client</p>
        <h1 class="section-title">Mes réservations</h1>
    </div>

    @forelse($reservations as $r)
        <div class="mb-3 fade-up fade-up-{{ ($loop->index % 3) + 1 }}"
             style="background:var(--white); border-radius:14px; border:1px solid rgba(196,149,106,0.12); overflow:hidden; transition:box-shadow 0.2s;"
             onmouseover="this.style.boxShadow='0 8px 30px rgba(26,22,18,0.08)'"
             onmouseout="this.style.boxShadow='none'">
            <div class="row g-0">
                {{-- Image thumb --}}
                <div class="col-md-3 d-none d-md-block">
                    @if($r->chambre->maison->image)
                        <img src="{{ asset('storage/' . $r->chambre->maison->image) }}"
                             style="width:100%; height:100%; min-height:160px; object-fit:cover;" alt="">
                    @else
                        <div style="background:var(--mist); height:100%; min-height:160px; display:flex; align-items:center; justify-content:center;">
                            <i class="bi bi-house" style="font-size:28px; color:#ccc;"></i>
                        </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="col-md-9">
                    <div style="padding:24px;">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 style="font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:500; margin-bottom:4px;">
                                    {{ $r->chambre->maison->nom }}
                                </h4>
                                <p style="font-size:13px; color:#888; margin:0;">
                                    <i class="bi bi-door-open me-1"></i>{{ $r->chambre->type }}
                                    @if($r->chambre->maison->ville)
                                        · <i class="bi bi-geo-alt ms-1 me-1"></i>{{ $r->chambre->maison->ville->nom }}
                                    @endif
                                </p>
                            </div>
                            @php
                                $badgeClass = $r->isPaid() ? 'badge-paid' : 'badge-pending';
                                $badgeLabel = $r->isPaid() ? 'Payée' : 'En attente';
                                if(isset($r->statut) && $r->statut === 'annulée') { $badgeClass = 'badge-cancelled'; $badgeLabel = 'Annulée'; }
                            @endphp
                            <span class="badge-status {{ $badgeClass }}">{{ $badgeLabel }}</span>
                        </div>

                        <div style="display:flex; gap:20px; font-size:13px; color:#888; margin-bottom:16px;">
                            <div>
                                <div style="font-size:11px; text-transform:uppercase; letter-spacing:0.08em; color:var(--clay); margin-bottom:2px;">Arrivée</div>
                                <div style="color:var(--ink); font-weight:500;">{{ \Carbon\Carbon::parse($r->date_debut)->format('d M Y') }}</div>
                            </div>
                            <div style="display:flex; align-items:center; color:#ddd;">→</div>
                            <div>
                                <div style="font-size:11px; text-transform:uppercase; letter-spacing:0.08em; color:var(--clay); margin-bottom:2px;">Départ</div>
                                <div style="color:var(--ink); font-weight:500;">{{ \Carbon\Carbon::parse($r->date_fin)->format('d M Y') }}</div>
                            </div>
                            <div style="margin-left:auto;">
                                <div style="font-size:11px; text-transform:uppercase; letter-spacing:0.08em; color:var(--clay); margin-bottom:2px;">Total</div>
                                <div style="font-family:'Cormorant Garamond',serif; font-size:22px; font-weight:600; color:var(--ink);">{{ $r->total }} DT</div>
                            </div>
                        </div>

                        <div style="display:flex; gap:10px;">
                            @if(!$r->isPaid())
                                <a href="{{ route('paiement.payer', $r->id) }}" class="btn-primary-custom" style="font-size:13px; padding:9px 20px;">
                                    <i class="bi bi-credit-card"></i> Payer maintenant
                                </a>
                            @endif

                            @if(!$r->isPaid() || (\Carbon\Carbon::now()->diffInHours($r->date_debut, false) >= 48))
                                <form method="POST" action="{{ route('reservations.destroy', $r->id) }}" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-custom"
                                            onclick="return confirm('Voulez-vous vraiment annuler cette réservation ?')">
                                        <i class="bi bi-x-circle me-1"></i>Annuler
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('maisons.show', $r->chambre->maison->id) }}" class="btn-outline-custom" style="font-size:13px; padding:9px 16px;">
                                Voir la maison →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div style="background:var(--white); border-radius:16px; border:1px dashed rgba(196,149,106,0.3); padding:64px 32px; text-align:center;">
            <i class="bi bi-calendar-x" style="font-size:48px; color:var(--clay); opacity:0.4;"></i>
            <h4 style="font-family:'Cormorant Garamond',serif; font-size:24px; margin:16px 0 8px;">Aucune réservation</h4>
            <p style="color:#888; font-size:14px;">Vous n'avez pas encore effectué de réservation.</p>
            <a href="{{ route('maisons.index') }}" class="btn-primary-custom d-inline-flex mt-3">
                <i class="bi bi-search"></i> Explorer les maisons
            </a>
        </div>
    @endforelse

</div>
@endsection