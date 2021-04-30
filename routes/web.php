<?php


use Illuminate\Support\Facades\Route;

use App\Models\Paciente;
use App\Models\Consulta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('prueba/{fecha_inicial}/{final_final}'  , function($fechaInicial, $fechaFinal){
    /*$consultas = Consulta::select(DB::raw('count(id) as cantidad, DATE(created_at) as fecha'))
                    ->whereDate('created_at', ">=", $fechaInicial)
                    ->whereDate('created_at', "<=", $fechaFinal)
                    ->groupBy('fecha')
                    ->get();*/
    $consultas = Consulta::select(DB::raw('count(id) as cantidad, date(created_at) as fecha'))
                            ->whereDate("created_at", ">=", $fechaInicial)
                            ->whereDate("created_at", "<=", $fechaFinal)
                            ->groupBy('fecha')
                            ->get();
    dd($consultas);
    foreach ($consultas as $item) {
        echo $item->paciente."<br><br>";
    }
    
    /*return [
        "consultas" => $consultas
    ];*/
});

Route::group(['prefix'=>'/'], function() use($router){
    $router->get('/',[App\Http\Controllers\HomeController::class,'index'])->name('login');
    $router->post('/login',[App\Http\Controllers\HomeController::class,'login']);
    $router->get('/logout',[App\Http\Controllers\HomeController::class,'logout'])->name('logout');

    $router->group(['prefix'=>'dashboard','middleware'=>['auth']], function() use($router) {
        //Panel
        $router->get('/home',[App\Http\Controllers\Dashboard\HomeController::class,'index'])->name('home');
        $router->post('/pacientes-graficas/{fecha_inicial}/{fecha_final}' , [App\Http\Controllers\Dashboard\HomeController::class, 'graficasPacientes']);
        $router->post('/consultas-graficas/{fecha_inicial}/{fecha_final}' , [App\Http\Controllers\Dashboard\HomeController::class, 'graficasConsultas']);
        //Estados y Ciudades
        $router->get('/estados', [App\Http\Controllers\Dashboard\EstadoController::class,'index']);
        $router->get('/estados/ciudades/{estado}', [App\Http\Controllers\Dashboard\EstadoController::class,'ciudades']);
        //Consultas
        $router->group(['prefix' => 'consultas'], function() use($router) {
            $router->get('/', [App\Http\Controllers\Dashboard\ConsultasController::class,'index'])->name('consultas');
            $router->post('/store',[App\Http\Controllers\Dashboard\ConsultasController::class,'store']);
            $router->post('/update/{id}',[App\Http\Controllers\Dashboard\ConsultasController::class,'update']);
            $router->get('/destroy/{id}',[App\Http\Controllers\Dashboard\ConsultasController::class,'destroy']);
            $router->get('/datatable', [App\Http\Controllers\Dashboard\ConsultasController::class,'datatable'])->name('consultas-datatable');
            $router->post('/buscar_paciente',[\App\Http\Controllers\Dashboard\ConsultasController::class,'buscar_paciente']);
            $router->get('/export-consultas',[App\Http\Controllers\ConsultaExportController::class,'exportConsultas'])->name('export-consultas');
            // AJAX
            
            /**
             * Imprimir Consulta
             */
            $router->get('/imprimir-consulta/{id}',[App\Http\Controllers\Dashboard\ConsultasController::class,'imprimirConsulta']);
        });
        //Pacientes
        $router->group(['prefix' => 'pacientes'], function() use($router) {
            $router->get('/', [App\Http\Controllers\Dashboard\PacientesController::class,'index'])->name('pacientes');
            $router->get('/:{id}',[App\Http\Controllers\Dashboard\PacientesController::class,'find']);
            $router->post('/store',[App\Http\Controllers\Dashboard\PacientesController::class,'store']);
            $router->post('/update/{id}',[App\Http\Controllers\Dashboard\PacientesController::class,'update']);
            $router->get('/destroy/{id}',[App\Http\Controllers\Dashboard\PacientesController::class,'destroy']);
            $router->get('/datatable', [App\Http\Controllers\Dashboard\PacientesController::class,'datatable'])->name('pacientes-datatable');
            //Consultas 
            $router->group(['prefix' => 'consultas'], function() use($router) {
                $router->get('/home/{id?}', [App\Http\Controllers\Dashboard\PacienteConsultasController::class,'index']);
                $router->post('/store',[App\Http\Controllers\Dashboard\PacienteConsultasController::class,'store']);
                $router->post('/update/{id}',[App\Http\Controllers\Dashboard\PacienteConsultasController::class,'update']);
                $router->get('/destroy/{id}',[App\Http\Controllers\Dashboard\PacienteConsultasController::class,'destroy']);
                $router->get('/datatable/{id}', [App\Http\Controllers\Dashboard\PacienteConsultasController::class,'datatable'])->name('consultas-datatable');
                $router->post('/buscar_paciente',[\App\Http\Controllers\Dashboard\PacienteConsultasController::class,'buscar_paciente']);
                $router->get('/export-consultas/{id}',[App\Http\Controllers\ConsultaExportController::class,'exportConsultasPaciente'])->name('export-consultas-paciente');
            });
        });

        //Configuracion del sistema
        $router->group(['prefix'=>'configuracion'], function() use($router) {
            $router->get('/',[App\Http\Controllers\Dashboard\Configuracion\HomeController::class,'index'])->name('configuracion');
            //Estados
            $router->post('/update/{medico}',[App\Http\Controllers\Dashboard\Configuracion\HomeController::class,'update'])->name('actualizar-configuracion');
			$router->group(['prefix'=>'estados'], function() use($router){

               $router->get('/',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'index'])->name('configuracion-estados');
               $router->get('/all',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'all']);
               $router->post('/store',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'store']);
               $router->post('/update/{estado}',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'update']);
               $router->get('/destroy/{estado}',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'destroy']);
               $router->get('/enable_all',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'enable_all']);
               $router->get('/disable_all',[\App\Http\Controllers\Dashboard\Configuracion\Estados\HomeController::class,'disable_all']);
               //Ciudades
               $router->group(['prefix'=>'ciudades'], function() use($router) {
                  $router->get('/home/{estado}',[App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'index'])->name('configuracion-estados-ciudades');
                  $router->get('/all/{estado}',[\App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'all']);
                  $router->get('/:{id}',[App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'find']);
                  $router->post('/store',[App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'store']);
                  $router->post('/update/{id}',[App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'update']);
                  $router->get('/destroy/{id}',[App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'destroy']);
                  $router->get('/enable_all/{estado}',[\App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'enable_all']);
                  $router->get('/disable_all/{estado}',[\App\Http\Controllers\Dashboard\Configuracion\Estados\CiudadesController::class,'disable_all']);
               });
            });

        });
        //Perfil de usuario
        $router->group(['prefix'=>'perfil'], function() use($router){
           $router->get('/',[App\Http\Controllers\Dashboard\Configuracion\PerfilController::class,'index']);
           $router->post('/update',[App\Http\Controllers\Dashboard\Configuracion\PerfilController::class,'update']);
        });
    });
});
