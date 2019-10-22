<?php


/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['middleware' => 'auth', 'prefix' => 'customers_groups'], function () use ($router) {
    $router->post('', [
        'uses' => 'CustomerGroupController@new'
    ]);

    $router->get('', [
        'uses' => 'CustomerGroupController@get'
    ]);
});
