<?php

namespace Database\Seeders;

use App\Models\Reactivo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReactivoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reactivo::factory()->count(10)->create();
    }
}
