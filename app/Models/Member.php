<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'name',
        'church_id',
        'user_id',
        'email',
        'contact_number',
        'age',
        'sex',
        'membership_date',
        'is_active',
    ];

    /**
     * Member belongs to a Church
     */
    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    /**
     * Member optionally belongs to a User account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get only active members
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}