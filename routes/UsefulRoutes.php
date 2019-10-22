<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => 'useful', 'middleware' => 'auth'], function (Router $router) {
    $router->get('cities', [
        'uses' => 'UsefulController@cities'
    ]);
    $router->get('states', [
        'uses' => 'UsefulController@states'
    ]);

    $router->get('status', [
        'uses' => 'UsefulController@status'
    ]);

    $router->get('product-producers', [
        'uses' => 'UsefulController@producer'
    ]);

});

