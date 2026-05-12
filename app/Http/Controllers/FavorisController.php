<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Maison;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    /**
     * Ajouter ou retirer une maison des favoris de l'utilisateur connecté
     */
    public function toggle(Maison $maison)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter un favori.');
        }

        if ($user->hasFavorited($maison)) {
            $user->favoris()->detach($maison->id);
            $message = 'Maison retirée de vos favoris.';
        } else {
            $user->favoris()->attach($maison->id);
            $message = 'Maison ajoutée à vos favoris.';
        }

        return back()->with('success', $message);
    }

    /**
     * Afficher la liste des maisons favorites de l'utilisateur connecté
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour voir vos favoris.');
        }

        $maisonsFavoris = $user->favoris()->get();

        return view('favoris.index', compact('maisonsFavoris'));
    }
}
