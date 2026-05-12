<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Chambre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 🔹 Créer une réservation
    public function create($chambre_id)
    {
        $chambre = Chambre::with('maison.ville')->findOrFail($chambre_id);
        return view('reservations.create', compact('chambre'));
    }

    // 🔹 Stocker la réservation
    public function store(Request $request)
    {
        $request->validate([
            'chambre_id' => 'required|exists:chambres,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $chambre = Chambre::findOrFail($request->chambre_id);

        // ✅ Calcul nombre de nuits
        $nbJours = Carbon::parse($request->date_debut)
            ->diffInDays(Carbon::parse($request->date_fin));

        if ($nbJours == 0) {
            $nbJours = 1;
        }

        // ✅ Calcul total
        $total = $nbJours * $chambre->prix;

        // ✅ Créer réservation
        Reservation::create([
            'user_id' => Auth::id(),
            'chambre_id' => $request->chambre_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'statut' => 'en_attente', // par défaut
            'total' => $total
        ]);

        return redirect()->route('reservations.index')->with('success', 'Réservation réussie');
    }

    // 🔹 Afficher les réservations de l'utilisateur
    public function index()
    {
        $reservations = Reservation::with('chambre.maison.ville')
            ->where('user_id', Auth::id())
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    // 🔹 Supprimer une réservation (optionnel)
    public function destroy(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }
        // Vérifier si la réservation est payée
    if ($reservation->isPaid()) {
        $hoursBeforeArrival = Carbon::now()->diffInHours($reservation->date_debut, false);

        // Annulation impossible si moins de 48h avant l'arrivée
        if ($hoursBeforeArrival < 48) {
            return back()->with('error', 'Annulation impossible à moins de 48h de l’arrivée.');
        }
    }

        $reservation->delete();
        return back()->with('success', 'Réservation annulée');
    }

    // 🔹 Afficher la page de paiement
    public function payer(Reservation $reservation)
    {
        // Sécurité : seul le propriétaire peut payer
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        return view('paiement.index', compact('reservation'));
    }

    // 🔹 Confirmer le paiement
    public function confirmer(Reservation $reservation)
    {
        // Sécurité : seul le propriétaire peut confirmer
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->update([
            'statut' => 'payée'
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Paiement effectué');
    }
}
