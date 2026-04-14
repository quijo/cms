<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 members
Member::factory()->count(20)->create();


// ChurchSeeder runs first
$this->call([
    ChurchSeeder::class,
    MemberSeeder::class,
]);

    }
}
