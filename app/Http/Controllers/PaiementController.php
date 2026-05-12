<?php
namespace App\Http\Controllers;

use App\Models\Reservation;

class PaiementController extends Controller
{
    public function payer(Reservation $reservation)
{
    return view('paiement.index', compact('reservation'));
}

public function confirmer(Reservation $reservation)
{
    $reservation->update([
        'statut' => 'payée'
    ]);

    return redirect()->route('reservations.index')->with('success', 'Paiement effectué');
}

}
