<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Giving extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'church_id',       // links to Church
        'or_number',       // required, unique
        'giving_date',     // required
        'type',            // tithesAndOffering, essentials, etc.
        'amount',          // required
        'payment_method',  // optional
        'notes',           // optional
    ];

     const TYPES = [
        'tithesAndOffering',
        'essentials',
        'districtBudget',
        'education',
        'mission',
        'WEF',
        'donation',
        'others',
    ];

 // Relationships
    public function church()
    {
        return $this->belongsTo(\App\Models\Church::class);
    }

    public function member()
{
    return $this->belongsTo(\App\Models\Member::class);
}
   
    // Optionally cast giving_date to a Carbon date object
    protected $casts = [
        'giving_date' => 'date',
        'amount' => 'decimal:2',
    ];



   
}