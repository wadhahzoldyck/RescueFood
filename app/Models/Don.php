<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;
    // Relation avec le modèle Nourriture
    public function nourriture()
    {
        return $this->belongsTo(Nourriture::class);
    }

    protected $fillable = [
        'nourriture_id',  // Référence à la classe Nourriture
        'quantité',
        'status',
    ];
    // Liste des statuts possibles
    const STATUSES = [
        'disponible',
        'fini',
        'expirer'
    ];
    protected $dates = ['dateExpiration', 'dateCollectePrevue']; // Ajoutez ici les champs de type date

    //dateExpiration formatée
    public function getFormattedDateExpirationAttribute()
    {
        return $this->dateExpiration ? Carbon::parse($this->dateExpiration)->format('d M Y') : null;
    }
        // Check if the donation has expired
        public function isExpired()
        {
            return $this->dateExpiration && Carbon::now()->greaterThan($this->dateExpiration);
        }

       // Méthode pour vérifier et gérer l'expiration
    public function checkExpiration()
    {
        // Vérifier si la date d'expiration est passée
        if ($this->dateExpiration && Carbon::now()->gt($this->dateExpiration)) {
            // Si le don est expiré, changer son statut à 'fini'
            $this->status = 'expirer';
            $this->save();  // Sauvegarder les modifications
        }
    }
}
