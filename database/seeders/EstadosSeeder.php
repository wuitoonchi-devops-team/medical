<?php
namespace Database\Seeders;

use App\Models\Estado;
use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = './estados.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Tabla -Estados- poblada correctamente...');
        $state = Estado::first();
        $state->estatus = 1;
        $state->save();
    }
}
