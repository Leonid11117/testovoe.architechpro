<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Moderators\IndexController;
use App\Http\Controllers\Moderators\DeleteController;
use App\Http\Controllers\Moderators\UpdateController;
use App\Http\Controllers\Moderators\CreateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'moderators', 'name' => 'moderators'], static function (\Illuminate\Routing\Router $router) {
    $router->post('/', CreateController::class);
    $router->get('/', IndexController::class);
    $router->put('/{id}', UpdateController::class)->whereNumber('id');
    $router->delete('/{id}', DeleteController::class)->whereNumber('id');
});
