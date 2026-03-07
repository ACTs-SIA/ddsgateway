<?php

/** @var \Laravel\Lumen\Routing\Router $router */

// Test route
$router->get('/test', function () {
    return 'Route working';
});

// Root route
$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ======================
// SITE 1 USERS
// ======================

$router->get('/users1', 'User1Controller@index');       // Get all users
$router->post('/users1', 'User1Controller@add');        // Create user
$router->get('/users1/{id}', 'User1Controller@show');   // Get user by ID
$router->put('/users1/{id}', 'User1Controller@update'); // Update user
$router->delete('/users1/{id}', 'User1Controller@delete'); // Delete user


// ======================
// SITE 2 USERS
// ======================

$router->get('/users2', 'User2Controller@index');       // Get all users
$router->post('/users2', 'User2Controller@add');        // Create user
$router->get('/users2/{id}', 'User2Controller@show');   // Get user by ID
$router->put('/users2/{id}', 'User2Controller@update'); // Update user
$router->delete('/users2/{id}', 'User2Controller@delete'); // Delete user