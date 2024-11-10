<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\AuthController;

Route::prefix('/api')
    ->middleware(['api'])
    ->controller(AuthController::class)
    ->group(function () {

        Route::post('login', 'login')->middleware(['guest:admin'])->name('login');

        Route::post('logout', 'logout')->middleware(['auth:admin']);

        Route::get('get-admin-permissions', 'getAdminPermissions')->middleware('auth:admin');
    });
