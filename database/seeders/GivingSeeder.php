<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Giving;

class GivingSeeder extends Seeder
{
    public function run(): void
    {
        Giving::factory()->count(50)->create();
    }
}