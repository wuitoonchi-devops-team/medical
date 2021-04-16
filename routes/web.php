<?php


use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'/'], function() use($router){
    $router->get('/',[App\Http\Controllers\HomeController::class,'index'])->name('login');
    $router->post('/login',[App\Http\Controllers\HomeController::class,'login']);
    $router->get('/logout',[App\Http\Controllers\HomeController::class,'logout'])->name('logout');

    $router->group(['prefix'=>'dashboard','middleware'=>['auth']], function() use($router) {
        //Panel
        $router->get('/home',[App\Http\Controllers\Dashboard\HomeController::class,'index']);
        //Estados y Ciudades
        //Estados y Ciudades
        $router->get('/estados', [App\Http\Controllers\Dashboard\EstadoController::class,'index']);
        $router->get('/estados/ciudades/{estado}', [App\Http\Controllers\Dashboard\EstadoController::class,'ciudades']);
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
                $router->get('/home/{id?}', [App\Http\Controllers\Dashboard\ConsultasController::class,'index'])->name('consultas');
                $router->post('/store',[App\Http\Controllers\Dashboard\ConsultasController::class,'store']);
                $router->post('/update/{id}',[App\Http\Controllers\Dashboard\ConsultasController::class,'update']);
                $router->get('/destroy/{id}',[App\Http\Controllers\Dashboard\ConsultasController::class,'destroy']);
                $router->get('/datatable', [App\Http\Controllers\Dashboard\ConsultasController::class,'datatable'])->name('consultas-datatable');
                $router->post('/buscar_paciente',[\App\Http\Controllers\Dashboard\ConsultasController::class,'buscar_paciente']);
            });
        });
    });
});
