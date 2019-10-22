<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->post('/auth', [
    'uses' => 'AuthController@authenticate'
]);

$router->get('/logout', [
    'middleware' => 'auth',
    'uses' => 'AuthController@logout'
]);
