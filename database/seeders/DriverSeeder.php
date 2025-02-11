<?php

namespace Database\Seeders;

use App\Models\driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::factory()->count(20)->create();
    }
}
