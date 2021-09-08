<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'api', 'prefix' => config('admin.prefix')], function ($router) {
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/avatar-uploads', [AuthController::class, 'avatar']);
        Route::put('/user-update', [AuthController::class, 'update']);
    });
    $router->resource('roles', \App\Http\Controllers\Api\RolesController::class);
    $router->resource('permissions', \App\Http\Controllers\Api\PermissionsController::class);
    $router->resource('users',\App\Http\Controllers\Api\UsersController::class);
    $router->post('users-assign-roles',[\App\Http\Controllers\Api\UsersController::class,'assignRole']);
});
