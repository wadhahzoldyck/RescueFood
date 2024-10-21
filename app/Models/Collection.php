<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = ['dateCollecte', 'etat','user_id'
];

    protected $dates = ['dateCollecte'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function listeDons()
    {
        return $this->hasMany(Don::class);
    }
}
