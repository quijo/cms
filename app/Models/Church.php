<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'church_number',
        'status',
        'start_date',
        'contact_address',
        'church_id', 
      
    ];

    protected $casts = [
    'start_date' => 'date',
];

    /**
     * A church has many users (members, pastors, etc.)
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Optional: Church has many giving records
     */
    public function givings()
    {
        return $this->hasMany(Giving::class);
    }

    

    public function church()
{
    return $this->belongsTo(Church::class);
}

public function run(): void
    {
        Church::factory()->count(5)->create();
    }
}