<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);

Route::get('posts', [App\Http\Controllers\Api\PostController::class, 'index']);
Route::get('posts/{id}', [App\Http\Controllers\Api\PostController::class, 'show']);

Route::get('categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('posts', [App\Http\Controllers\Api\PostController::class, 'store']);
    Route::put('posts/{id}', [App\Http\Controllers\Api\PostController::class, 'update']);
    Route::delete('posts/{id}', [App\Http\Controllers\Api\PostController::class, 'destroy']);

    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::fallback(function () {
    return \Response::json([
        'data' => [
            'message' => 'Not Found.',
            'status_code' => 404
        ]
    ], 404);
})->name('api.fallback.404');
