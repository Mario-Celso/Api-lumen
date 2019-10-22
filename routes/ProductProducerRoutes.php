<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'product-producers', 'middleware' => 'auth'], function (Router $router) {
    $router->post('', [
        'uses' => 'ProductProducerController@new'
    ]);
    $router->get('', [
        'uses' => 'ProductProducerController@get'
    ]);


    $router->group(['prefix' => '/{id}'], function () use ($router) {
//        $router->patch('', [
//            'uses' => 'ProductProducerController@edit'
//        ]);
        $router->delete('', [
            'uses' => 'ProductProducerController@delete'
        ]);

    });

});
