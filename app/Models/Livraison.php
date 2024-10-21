<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $fillable = ['adresse', 'etat', 'date_livraison', 'livreur_id', 'distribution_id'];
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }

    public function distribution()
    {
            // return $this->belongsTo(Distribution::class);
    }
    use HasFactory;
}
