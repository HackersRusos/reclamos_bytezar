<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LimpiarReclamosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Borra todos los reclamos y reinicia el ID desde 1
        DB::statement('TRUNCATE TABLE reclamos RESTART IDENTITY CASCADE');
    }
}
