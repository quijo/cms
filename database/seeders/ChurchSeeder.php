<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
       

       // Create 5 churches
Church::factory()->count(5)->create();
    }
}