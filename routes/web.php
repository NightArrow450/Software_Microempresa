<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.authenticate');

});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Rutas exclusivas del Administrador
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:Administrador')->group(function () {

        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/usuarios/nuevo', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/usuarios', [UserController::class, 'store'])
            ->name('users.store');

        Route::get('/usuarios/{user}', [UserController::class, 'show'])
            ->name('users.show');

        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])
            ->name('users.edit');

        Route::put('/usuarios/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::patch('/usuarios/{user}/estado', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');


        /*
        |--------------------------------------------------------------------------
        | Ruta temporal para probar permisos
        |--------------------------------------------------------------------------
        */

        Route::get('/admin-prueba', function () {
            return 'Acceso permitido solamente para Administrador';
        });

    });

});