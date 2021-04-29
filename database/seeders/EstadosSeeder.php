<?php
namespace Database\Seeders;

use App\Models\Ciudad;
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
        Estado::all()->map(function($estado) {
            $estado->estatus = 1;
            $estado->save();
        });
        Ciudad::all()->map(function($ciudad){
            $ciudad->estatus = 1;
            $ciudad->save();
        });
    }
}
