<?php

use Illuminate\Support\Facades\Route;
//
use App\Http\Livewire\Component;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\ImportExportController;

Route::get('/', function () {
    return view('welcome');
});

// Livewire
// Route::get('/register', function () {
//     return view('register');
// });
Route::get('/register', \App\Http\Livewire\register::class);
// Route::get('/register', \App\Http\Livewire\register::class)->layout('layouts.base');

// sistema BANCA
Route::group(['prefix' => 'banca'], function () {
    Route::get('/traspasos', [ImportExportController::class, 'showImportForm'])->name('banca.showImportForm');
    Route::post('/traspasos', [ImportExportController::class, 'import'])->name('banca.import');
    Route::post('/traspasos/duplicados', [ImportExportController::class, 'eliminarRegistrosDuplicados'])->name('banca.eliminar.duplicados');
    Route::post('/traspasos/movimientos', [ImportExportController::class, 'pasar'])->name('banca.crearMovimientos');
});

// -- define idioma --
Route::get('/greeting/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'es', 'fr'])) {
        // abort(400);
        $locale = 'fr';
    }
    App::setLocale($locale);
    session(['locale' => $locale]);
    return redirect('/');
});
// -- fin define idioma --

Route::controller(PrincipalController::class)
    ->prefix('')
    ->as('')
    ->group(function () {
        route::get('/', 'home')->name('home');
        route::get('/testInput', 'testInput')->name('testInput');
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
    Route::get('user/list', [UserController::class, 'indexUsers'])
        ->name('user.list')
        ->middleware('guzanet4:admin|user');
    Route::get('role/list', [UserController::class, 'indexRoles'])
        ->name('role.list')
        ->middleware('guzanet4:admin');
    Route::view('seller/list', 'seller.list')
        ->name('seller.list')
        ->middleware('guzanet4:admin|seller');
    Route::view('client/list', 'client.list')
        ->name('client.list')
        ->middleware('guzanet4:admin|client');
});

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('users', function () {
//         return view('backend.users.index');
//     })->name('users');
// });

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
