<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosSeeder::class);
        $this->call(CiudadesSeeder::class);
        \App\Models\User::factory(1)->create();
        //$this->call(PacienteSeeder::class);
    }
}
