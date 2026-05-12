<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Maison;
use App\Models\Reservation;
use App\Models\Avis;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Les attributs autorisés en mass assignment
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Les attributs cachés (sécurité)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les castings (important pour hash automatique)
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // hash automatique
    ];

    // =========================
    // 🔗 RELATIONS
    // =========================

    /**
     * Relation favoris : un user peut avoir plusieurs maisons favorites
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Maison>
     */
    public function favoris(): BelongsToMany
    {
        return $this->belongsToMany(Maison::class, 'favoris', 'user_id', 'maison_id');
    }

    /**
     * Vérifier si l'utilisateur a déjà favorisé une maison
     *
     * @param \App\Models\Maison $maison
     * @return bool
     */
    public function hasFavorited(Maison $maison): bool
    {
        return $this->favoris()->where('maison_id', $maison->id)->exists();
    }

    /**
     * Un utilisateur a plusieurs réservations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Reservation>
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Un utilisateur a plusieurs avis
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Avis>
     */
    public function avis()
    {
        return $this->hasMany(Avis::class);
    }
}
