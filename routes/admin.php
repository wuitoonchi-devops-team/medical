<?php
$router->group(['prefix'=>'admin'], function() use($router) {
    $router->group(['prefix'=>'auth'], function() use($router) {
        $router->post('login',[App\Http\Controllers\Api\Admin\AuthController::class ,'login']);
    });
    $router->group(['prefix' => '','middleware' => ['auth:sanctum']], function() use($router) {
        $router->group(['prefix' => ''], function () use ($router) {
            $router->group(['prefix'=>'account'], function () use ($router) {
                $router->get('user', [App\Http\Controllers\Api\Admin\AuthController::class,'user']);
                $router->get('logout', [App\Http\Controllers\Api\Admin\AuthController::class,'logout']);
            });
            //Estados y Ciudades
            $router->get('/estados', [App\Http\Controllers\Api\Admin\EstadoController::class,'index']);
            $router->get('/estados/ciudades/{estado}', [App\Http\Controllers\Api\Admin\EstadoController::class,'ciudades']);
            //Dashboard Resumen
            $router->group(['prefix' => 'dashboard'], function() use($router) {
                $router->get('/',[App\Http\Controllers\Api\Admin\DashboardController::class,'index']);
            });
            //Consultas
            $router->resource('/consultas', App\Http\Controllers\Api\Admin\ConsultaController::class);
            $router->post('/consultas/datatable', [App\Http\Controllers\Api\Admin\ConsultaController::class,'index']);
            //Pacientes
            $router->resource('/pacientes', App\Http\Controllers\Api\Admin\PacienteController::class);
            $router->post('/pacientes/datatable', [App\Http\Controllers\Api\Admin\PacienteController::class,'index']);

        });
    });
});
