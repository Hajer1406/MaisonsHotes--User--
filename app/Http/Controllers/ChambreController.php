<?php

namespace App\Http\Controllers;

use App\Models\Chambre;

class ChambreController extends Controller
{
    // Pour l'interface user, cette méthode est optionnelle
    public function index()
    {
        $chambres = Chambre::with('maison')->get();
        return view('chambres.index', compact('chambres'));
    }
}
