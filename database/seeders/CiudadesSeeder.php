<?php
namespace Database\Seeders;
use App\Models\Ciudad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = './ciudades.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Tabla -Ciudades- poblada correctamente...');
        Ciudad::where('estado_id',1)->get()->map(function($ciudad) {
            $ciudad->estatus = 1;
            $ciudad->save();
        });
    }
}
