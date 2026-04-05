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

    // SITE 1 USERS
    $router->get('/users1', 'User1Controller@index');
    $router->post('/users1', 'User1Controller@add');
    $router->get('/users1/{id}', 'User1Controller@show');
    $router->put('/users1/{id}', 'User1Controller@update');
    $router->delete('/users1/{id}', 'User1Controller@delete');

    // MOVIE USERS 
    $router->get('/MovUser', 'MovieUserController@index');
    $router->get('/MovUser/{id}', 'MovieUserController@show');
    $router->put('/MovUser/{id}', 'MovieUserController@update');
    $router->delete('/MovUser/{id}', 'MovieUserController@delete');

    // SITE 2 USERS
    $router->get('/users2', 'User2Controller@index');
    $router->post('/users2', 'User2Controller@add');
    $router->get('/users2/{id}', 'User2Controller@show');
    $router->put('/users2/{id}', 'User2Controller@update');
    $router->delete('/users2/{id}', 'User2Controller@delete');

    $router->get('/movie', 'MovieController@index');
    $router->post('/movie', 'MovieController@add');
    $router->get('/movie/{id}', 'MovieController@show'); 
    $router->put('/movie/{id}', 'MovieController@update');
    $router->delete('/movie/{id}', 'MovieController@delete');
});