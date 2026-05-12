@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <h3 class="mb-4 text-center">Réserver une chambre</h3>

                <form method="POST" action="{{ route('reservations.store') }}">
                    @csrf
                    <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">

                    <div class="mb-3">
                        <label for="date_debut" class="form-label fw-bold">Date d'arrivée</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="date_fin" class="form-label fw-bold">Date de départ</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100 fw-bold">Confirmer réservation</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
