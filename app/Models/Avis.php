<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = [
        'user_id',
        'maison_id',
        'commentaire',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maison()
    {
        return $this->belongsTo(Maison::class);
    }
}