<?php

/** @var Router $router */


use Laravel\Lumen\Routing\Router;

$router->group(['middleware' => 'auth', 'prefix' => 'providers'], function () use ($router) {
    $router->post('', [
        'uses' => 'ProviderController@new'
    ]);

    $router->get('', [
        'uses' => 'ProviderController@get'
    ]);

    $router->group(['prefix' => '/{id}'], function () use ($router) {
        $router->patch('', [
            'uses' => 'ProviderController@edit'
        ]);

        $router->delete('', [
            'uses' => 'ProviderController@delete'
        ]);
    });
});
