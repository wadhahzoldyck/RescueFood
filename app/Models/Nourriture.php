<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nourriture extends Model
{
    use HasFactory;
    // Types de nourriture disponibles
    const TYPES_NOURRITURE = [
        'Fruits',
        'Légumes',
        'Viande',
        'Poisson',
        'Produits laitiers',
        'Pain et céréales',
        'Produits surgelés',
        'Produits en conserve',
        'Produits secs',
        'Produits de boulangerie',
        'Snacks',
        'Boissons',
        'Condiments',
        'Épices',
        'Plats préparés',
    ];
    protected $fillable = ['nom', 'type'];
    public function recommandations()
    {
        return $this->hasMany(Recommandation::class);
    }
}
