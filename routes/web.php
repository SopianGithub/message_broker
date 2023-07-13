<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('invoice', [
    'uses' => 'Invoices@index'
]);

$router->get('task', [
    'uses' => 'Invoices@reader'
]);

$router->get('services', [
    'uses' => 'Invoices@testAPI'
]);

$router->get('telegram', [
    'uses' => 'Invoices@telegram'
]);

$router->group(['prefix' => 'message'], function () use ($router) {
    
    $router->post('store', [
        'uses' => 'ConsumeApi@storeAPI'
    ]);

});

$router->group(['prefix' => 'admin'], function () use ($router) {

    $router->get('/test', function (){
        echo "test";
    });

    $router->get('user/auth/{id}', [
        'uses' => 'MgtUserAuthAPI@view'
    ]);

    $router->post('user/authcreate', [
        'uses' => 'MgtUserAuthAPI@store'
    ]);

    $router->put('user/authcreate/{id}', [
        'uses' => 'MgtUserAuthAPI@update'
    ]);

});
