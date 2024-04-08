<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'AuthController@login');
$router->get('/asistencias', 'AsistenciaController@index');

$router->group(['middleware' => 'jwt'], function () use ($router) {
    $router->get('/visitantes/{dni}/dni', 'VisitanteController@buscarPorDni');
    $router->get('/visitantes/{ruc}/ruc', 'VisitanteController@buscarPorRuc');
    $router->get('/entidades/{visitante_id}/visitante', 'EntidadController@index');
    $router->get('/lugares', 'LugarController@index');
    $router->get('/funcionarios/{lugar_id}/lugar', 'FuncionarioController@index');
    $router->group(['middleware' => 'role:admin'], function () use ($router) {
        $router->get('/users', 'UserController@index');
        $router->post('/users', 'UserController@store');
        $router->get('/users/{id}', 'UserController@show');
        $router->put('/users/{id}', 'UserController@update');
        $router->delete('/users/{id}', 'UserController@destroy');
        $router->get('/visitantes', 'VisitanteController@index');
        $router->post('/visitantes', 'VisitanteController@store');
        $router->get('/visitantes/{id}', 'VisitanteController@show');
        $router->put('/visitantes/{id}', 'VisitanteController@update');
        $router->delete('/visitantes/{id}', 'VisitanteController@destroy');
        $router->post('/entidades', 'EntidadController@store');
        $router->get('/entidades/{id}', 'EntidadController@show');
        $router->put('/entidades/{id}', 'EntidadController@update');
        $router->delete('/entidades/{id}', 'EntidadController@destroy');
        $router->post('/lugares', 'LugarController@store');
        $router->get('/lugares/{id}', 'LugarController@show');
        $router->put('/lugares/{id}', 'LugarController@update');
        $router->delete('/lugares/{id}', 'LugarController@destroy');
        $router->post('/funcionarios', 'FuncionarioController@store');
        $router->get('/funcionarios/{id}', 'FuncionarioController@show');
        $router->put('/funcionarios/{id}', 'FuncionarioController@update');
        $router->delete('/funcionarios/{id}', 'FuncionarioController@destroy');
    });
    $router->group(['middleware' => 'role:user'], function () use ($router) {
        $router->post('/asistencias', 'AsistenciaController@store');
        $router->get('/asistencias/{asistencia}', 'AsistenciaController@show');
        $router->put('/asistencias/{asistencia}', 'AsistenciaController@update');
        $router->delete('/asistencias/{asistencia}', 'AsistenciaController@destroy');
    });
});
