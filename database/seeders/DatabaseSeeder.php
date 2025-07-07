<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        DB::statement('TRUNCATE TABLE reclamos RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE tipo_reclamos RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE categoria_reclamos RESTART IDENTITY CASCADE');
        DB::statement('TRUNCATE TABLE users RESTART IDENTITY CASCADE');

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('Admin123'), // o la contraseña que vos quieras
            'is_admin' => true, // o true si querés que sea admin
        ]);
        // Llamar a los seeders específicos
        $this->call(CategoriaReclamoSeeder::class);
    }
}
