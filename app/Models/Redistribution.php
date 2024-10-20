<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Redistribution extends Model
{
    use HasFactory;

    // Relationship with Beneficiaire
    public function beneficiaire()
    {
        return $this->belongsTo(Beneficiaire::class);
    }

    protected $fillable = [
        'date',
        'status',
        'beneficiaire_id',
    ];

    // List of possible statuses
    const STATUSES = [
        'loading',       // Redistribution is in progress
        'completed',      // Redistribution has been completed
        'canceled',        // Redistribution has been cancelled
    ];

    // Define 'date' as a Carbon instance
    protected $dates = ['date'];

    // Accessor to get the date in a formatted way
    public function getFormattedDateAttribute()
    {
        return $this->date ? Carbon::parse($this->date)->format('d M Y') : null;
    }

    // Accessor to get a human-readable status
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}
