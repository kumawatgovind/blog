<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PostController;

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
Route::group(['namespace' => 'Api\V1', 'as' => 'api.', 'prefix' => 'v1'], function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('/category', [CategoryController::class, 'index']);
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index']);
            Route::post('/create', [PostController::class, 'create']);
        });
    });
});
