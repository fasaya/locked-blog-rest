<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return \Response::json([
        'data' => [
            'message' => 'Hello world!',
            'status_code' => 200
        ]
    ], 200);
});


// Route::get('login', function () {
//     return \Response::json([
//         'data' => [
//             'message' => 'Unauthorized',
//             'status_code' => 200
//         ]
//     ], 200);
// })->name('login');


// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['role:admin', 'auth']], function () {

//     Route::get('users-search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('users.search');

//     Route::resource('promo', App\Http\Controllers\Admin\MerchantPromoController::class);
// });
