<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Chambre;
use App\Models\Avis;
use App\Models\User;

class Maison extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'description',
        'image',
        'ville_id'
    ];

    // Une maison a plusieurs chambres
    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }

    // Une maison a plusieurs avis
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    // Une maison appartient à une ville
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }

    // ✅ Relation favoris (many-to-many)
    public function usersFavoris()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    // ✅ Vérifier si un user a favori
    public function isFavoritedBy($userId)
    {
        return $this->usersFavoris()->where('user_id', $userId)->exists();
    }
}
