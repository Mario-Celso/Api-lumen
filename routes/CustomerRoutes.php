<?php


/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['middleware' => 'auth', 'prefix' => 'customers'], function () use ($router) {
    $router->post('', [
        'uses' => 'CustomerController@new'
    ]);

    $router->get('', [
        'uses' => 'CustomerController@get'
    ]);

    $router->group(['prefix' => '/{id}'], function () use ($router) {
        $router->patch('', [
            'uses' => 'CustomerController@edit'
        ]);

        $router->delete('', [
            'uses' => 'CustomerController@delete'
        ]);
    });
});
