<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return \Response::json([
        'data' => [
            'message' => 'Hello world!',
            'status_code' => 200
        ]
    ], 200);
});

Route::group(['prefix' => 'v1/'], function () {

    Route::get('/', function () {
        return \Response::json([
            'data' => [
                'message' => 'Hello world!',
                'status_code' => 200
            ]
        ], 200);
    });
});


Route::fallback(function () {
    return \Response::json(
        [
            'data' => [
                'message' => 'Not Found.',
                'status_code' => 404
            ]
        ],
        404
    );
})->name('api.fallback.404');
