<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'chambre_id',
        'date_debut',
        'date_fin',
        'statut',  // ✅ ajout
        'total'    // ✅ ajout
    ];

    // Une réservation appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une réservation appartient à une chambre
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    // ✅ Vérifier si la réservation est payée
    public function isPaid()
    {
        return $this->statut === 'payée';
    }
}
