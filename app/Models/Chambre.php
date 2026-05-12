<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    protected $fillable = [
        'type',
        'prix',
        'disponible',
        'maison_id'
    ];

    // Une chambre appartient à une maison
    public function maison()
    {
        return $this->belongsTo(Maison::class);
    }

    // Une chambre a plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}