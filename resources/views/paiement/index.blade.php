@extends('layouts.app')

@section('content')
<div class="py-4">

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="text-center mb-4">
                <p class="section-eyebrow">Finaliser</p>
                <h1 class="section-title">Paiement de la réservation</h1>
            </div>

            {{-- RESERVATION SUMMARY --}}
            <div style="background:var(--ink); border-radius:16px; padding:28px; margin-bottom:20px; position:relative; overflow:hidden;">
                <div style="position:absolute; top:0; right:0; width:200px; height:200px; background:rgba(196,149,106,0.08); border-radius:50%; transform:translate(40%, -40%);"></div>
                <div style="position:relative; z-index:1;">
                    <p style="font-size:11px; text-transform:uppercase; letter-spacing:0.15em; color:var(--clay); margin-bottom:16px;">Récapitulatif</p>
                    <h3 style="font-family:'Cormorant Garamond',serif; font-size:26px; color:white; font-weight:400; margin-bottom:4px;">
                        {{ $reservation->chambre->maison->nom }}
                    </h3>
                    <p style="color:rgba(255,255,255,0.5); font-size:13px; margin-bottom:24px;">
                        {{ $reservation->chambre->type }}
                    </p>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div>
                            <div style="font-size:10px; text-transform:uppercase; letter-spacing:0.1em; color:rgba(255,255,255,0.4); margin-bottom:4px;">Arrivée</div>
                            <div style="color:white; font-size:15px;">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d M Y') }}</div>
                        </div>
                        <div>
                            <div style="font-size:10px; text-transform:uppercase; letter-spacing:0.1em; color:rgba(255,255,255,0.4); margin-bottom:4px;">Départ</div>
                            <div style="color:white; font-size:15px;">{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div style="border-top:1px solid rgba(255,255,255,0.08); margin-top:20px; padding-top:20px; display:flex; justify-content:space-between; align-items:baseline;">
                        <span style="color:rgba(255,255,255,0.5); font-size:13px;">Total à payer</span>
                        <span style="font-family:'Cormorant Garamond',serif; font-size:36px; font-weight:600; color:var(--clay);">
                            {{ $reservation->total }} DT
                        </span>
                    </div>
                </div>
            </div>

            {{-- PAYMENT FORM --}}
            <div class="form-card">
                <h4 style="font-family:'Cormorant Garamond',serif; font-size:20px; font-weight:500; margin-bottom:6px;">Informations de paiement</h4>
                <p style="font-size:13px; color:#888; margin-bottom:24px; padding-bottom:20px; border-bottom:1px solid var(--mist);">
                    Paiement sécurisé — vos données sont protégées.
                </p>

                <form method="POST" action="{{ route('paiement.confirmer', $reservation->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label-custom">Numéro de carte</label>
                        <input type="text" class="form-control-custom" placeholder="1234 5678 9012 3456"
                               maxlength="19" oninput="this.value=this.value.replace(/\D/g,'').replace(/(\d{4})/g,'$1 ').trim()">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <label class="form-label-custom">Date d'expiration</label>
                            <input type="text" class="form-control-custom" placeholder="MM / AA" maxlength="7">
                        </div>
                        <div class="col-6">
                            <label class="form-label-custom">CVV</label>
                            <input type="text" class="form-control-custom" placeholder="•••" maxlength="3">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Nom du titulaire</label>
                        <input type="text" class="form-control-custom" placeholder="Prénom Nom" value="{{ auth()->user()->name ?? '' }}">
                    </div>

                    <div style="background:#F9F5F0; border-radius:10px; padding:14px 16px; font-size:13px; color:#888; margin-bottom:24px; display:flex; align-items:center; gap:10px;">
                        <i class="bi bi-lock-fill" style="color:var(--clay);"></i>
                        Paiement crypté SSL. Vos données ne sont jamais stockées.
                    </div>

                    <button type="submit" class="btn-primary-custom w-100 justify-content-center" style="padding:15px;">
                        <i class="bi bi-credit-card-2-front"></i>
                        Confirmer le paiement de {{ $reservation->total }} DT
                    </button>
                </form>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('reservations.index') }}" style="font-size:13px; color:#aaa; text-decoration:none;">
                    ← Retour à mes réservations
                </a>
            </div>

        </div>
    </div>
</div>
@endsection