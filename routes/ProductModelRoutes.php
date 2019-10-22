<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'product-models', 'middleware' => 'auth'], function (Router $router) {
    $router->post('', [
        'uses' => 'ProductModelController@new'
    ]);
    $router->get('', [
        'uses' => 'ProductModelController@get'
    ]);


    $router->group(['prefix' => '/{id}'], function () use ($router) {
//        $router->patch('', [
//            'uses' => 'ProductModelController@edit'
//        ]);
        $router->delete('', [
            'uses' => 'ProductModelController@delete'
        ]);

    });

});
