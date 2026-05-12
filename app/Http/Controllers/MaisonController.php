<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use App\Models\Ville;
use Illuminate\Http\Request;

class MaisonController extends Controller
{
    // 🔹 Lister toutes les maisons
    public function index(Request $request)
    {
        $query = Maison::with(['chambres', 'avis', 'ville'])->withCount('chambres');

        // ✅ Filtre par ville (nom ou identifiant)
        if ($request->filled('ville')) {
            $query->whereHas('ville', function ($q) use ($request) {
                $q->where('nom', 'like', '%' . $request->ville . '%');
            });
        }

        // ✅ Filtre par ville via dropdown
        if ($request->filled('ville_id')) {
            $query->where('ville_id', $request->ville_id);
        }

        // ✅ Filtre par prix max (sur chambres)
        if ($request->filled('prix_max')) {
            $query->whereHas('chambres', function ($q) use ($request) {
                $q->where('prix', '<=', $request->prix_max);
            });
        }

        // ✅ Filtre par nombre minimum de chambres
        if ($request->filled('chambres_min')) {
            $query->having('chambres_count', '>=', $request->chambres_min);
        }

        // ✅ Pagination (meilleur que get())
        $maisons = $query->latest()->paginate(6);

        // ✅ Liste des villes pour filtre
        $villes = Ville::all();

        return view('maisons.index', compact('maisons', 'villes'));
    }

    // 🔹 Voir une maison en détail
    public function show(Maison $maison)
    {
        $maison->load(['chambres', 'avis', 'ville']);

        // ✅ utiliser même dossier "user"
        return view('maisons.show', compact('maison'));
    }
}
