<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['dateCollecte', 'etat'];

    protected $dates = ['dateCollecte'];

    
    public function listeDons()
    {
        return $this->hasMany(Don::class);
    }
}
