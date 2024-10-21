<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admins\Controllers\AdminController;

Route::middleware(['api'])->prefix('/api/admins/')->controller(AdminController::class)->group(function () {
    Route::get('get-all', 'getAll');
    Route::get('get-paginated-list', 'getPaginatedList');
    Route::post('store', 'store');
    Route::post('show/{id}', 'show');
    Route::post('update/{id}', 'update');
    Route::post('delete/{id}', 'destroy');

    Route::get('get-status', 'getStatus');

    Route::get('get-genders', 'getGenders');
});
