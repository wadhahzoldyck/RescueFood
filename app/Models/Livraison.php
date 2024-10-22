<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $fillable = ['adresse', 'etat', 'date_livraison', 'livreur_id', 'redistribution_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }

    public function redistribution()
    {
        return $this->belongsTo(Redistribution::class);
    }
    use HasFactory;
}
