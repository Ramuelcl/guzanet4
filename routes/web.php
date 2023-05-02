<?php

use Illuminate\Support\Facades\Route;
//
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\backend\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PrincipalController::class)
    ->prefix('')
    ->as('')
    ->group(function () {
        route::get('/', 'home')->name('home');
        route::get('/porDefinir', 'porDefinir')->name('porDefinir');
        route::get('/acercade', 'acercade')->name('acercade');
        route::get('/contacto', 'contacto')->name('contacto');
        route::post('/contacto', 'contacto')->name('contacto.enviar');
        Route::get('/linkstorage', function () {
            $targetFolder = base_path() . '/storage/app/public';
            $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
            dump($targetFolder, $linkFolder);
        });
    });

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('user/list', [UserController::class, 'index'])->name('user.list')->middleware('role:admin');
    Route::view('seller/list', 'seller.list')->name('seller.list')->middleware('role:admin|seller');
    Route::view('client/list', 'client.list')->name('client.list')->middleware('role:admin|client');
    Route::view('backend/roles', 'backend.roles')->name('roles.list')->middleware('role:admin');
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('users', function () {
//         return view('backend.users.index');
//     })->name('users');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
