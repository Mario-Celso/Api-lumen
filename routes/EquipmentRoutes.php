<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'equipments', 'middleware' => 'auth'], function (Router $router) {
    $router->post('', [
        'uses' => 'EquipmentController@new'
    ]);
    $router->get('', [
        'uses' => 'EquipmentController@get'
    ]);
    $router->group(['prefix' => '/{id}'], function () use ($router) {
        $router->patch('', [
            'uses' => 'EquipmentController@edit'
        ]);
        $router->delete('', [
            'uses' => 'EquipmentController@delete'
        ]);
    });

});

