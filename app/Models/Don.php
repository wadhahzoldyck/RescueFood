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
        'collection_id'
    ];
    // Liste des statuts possibles
    const STATUSES = [
        'disponible',
        'fini'
    ];
    protected $dates = ['dateExpiration', 'dateCollectePrevue']; // Ajoutez ici les champs de type date

    //dateExpiration formatée
    public function getFormattedDateExpirationAttribute()
    {
        return $this->dateExpiration ? Carbon::parse($this->dateExpiration)->format('d M Y') : null;
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    
}
