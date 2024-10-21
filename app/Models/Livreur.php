<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'telephone',
        'vehicule',
        'disponibilite',
        'zone_couverture',
        'email'
    ];

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}
