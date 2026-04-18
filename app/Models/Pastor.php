<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pastor extends Model
{
    protected $fillable = [
    'first_name',
    'last_name',
    'role',
    'status',
    'church_id',
    'photo',
    'email',
    'phone',
    'date_of_birth',
    'address',
    'ordination_status',
    'profile_picture',
];


public function getFullNameAttribute()
{
    return $this->first_name . ' ' . $this->last_name;
}

public function church()
{
    return $this->belongsTo(Church::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
