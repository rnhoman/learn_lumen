<?php
use \Laravel\Lumen\Routing\Router as router;

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

// $router->post('/create', function() use ($router) {
//     $router->post(['create'], 'ProdukController@create');
// });

$router->post('/create', 'ProdukController@create');
$router->get('/index', 'ProdukController@index');
$router->get('/index/{id}', 'ProdukController@show');
$router->put('/update/{id}', 'ProdukController@update');
$router->delete('/delete/{id}', 'ProdukController@destroy');
$router->post('/registrasi', 'UsersController@register');
$router->post('/login', 'UsersController@login');