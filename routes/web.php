<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->post('/login', 'AuthController@login');
$router->post('/MovUser', 'MovieUserController@add');
$router->post('/register', 'AuthController@register');

$router->get('/test', function () {
    return 'Route working';
});


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('/profile', function () {
        return response()->json(auth()->user());
    });

    // MOVIE USERS 
    $router->get('/MovUser', 'MovieUserController@index');
    $router->get('/MovUser/{id}', 'MovieUserController@show');
    $router->put('/MovUser/{id}', 'MovieUserController@update');
    $router->delete('/MovUser/{id}', 'MovieUserController@delete');

    // MOVIES DETAILS
    $router->get('/movie', 'MovieController@index');
    $router->post('/movie/create', 'MovieController@add');
    $router->get('/movie/{id}', 'MovieController@show'); 
    $router->put('/movie/{id}', 'MovieController@update');
    $router->delete('/movie/{id}', 'MovieController@delete');
});