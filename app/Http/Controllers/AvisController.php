<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    // Ajouter un avis
    public function store(Request $request)
    {
        $request->validate([
            'maison_id' => 'required|exists:maisons,id',
            'commentaire' => 'required|string|max:1000',
            'note' => 'required|integer|min:1|max:5',
        ]);

        Avis::create([
            'user_id' => Auth::id(),
            'maison_id' => $request->maison_id,
            'commentaire' => $request->commentaire,
            'note' => $request->note,
        ]);

        return back()->with('success', 'Avis ajouté avec succès');
    }

    // Supprimer un avis (optionnel : seulement l’utilisateur qui l’a créé)
    public function destroy(Avis $avis)
    {
        if ($avis->user_id !== Auth::id()) {
            abort(403);
        }

        $avis->delete();
        return back()->with('success', 'Avis supprimé');
    }
}
