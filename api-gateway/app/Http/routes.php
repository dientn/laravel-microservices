<?php

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

$app->get('/', function () use ($app) {
    return app()->version();
});

//'middleware' => 'auth',
//$app->get('/me', [ 'middleware' => 'auth', function (\Illuminate\Http\Request $request) {
//    return json_encode($request->user());
//}]);
$app->get('/me', 'AuthController@me');

$app->group([
    'prefix' => 'auth'
], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
});

