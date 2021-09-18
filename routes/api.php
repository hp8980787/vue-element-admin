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
    $router->get('users-get-roles',[\App\Http\Controllers\Api\UsersController::class,'roles']);
    $router->post('users-domains',[\App\Http\Controllers\Api\UsersController::class,'domains']);
    $router->get('users-domains',[\App\Http\Controllers\Api\UsersController::class,'domainsList']);

    $router->resource('domains',\App\Http\Controllers\Api\DomainsController::class);
    $router->get('domains-all',[\App\Http\Controllers\Api\DomainsController::class,'allDomains']);
    $router->get('domains-check-expired-time',[\App\Http\Controllers\Api\DomainsController::class,'check']);

    $router->get('databases/{id}/tables-name/',[\App\Http\Controllers\Api\DatabasesController::class,'tablesName']);
    $router->get('databases/{id}/tables-info/',[\App\Http\Controllers\Api\DatabasesController::class,'tablesInfo']);
    $router->resource('databases',\App\Http\Controllers\Api\DatabasesController::class);
    $router->get('databases-all',[\App\Http\Controllers\Api\DatabasesController::class,'allDatabases']);

    $router->get('orders-database',[\App\Http\Controllers\Api\OrdersController::class,'database']);
    $router->resource('tables',\App\Http\Controllers\Api\TablesController::class);
});
