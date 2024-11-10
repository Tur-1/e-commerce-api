<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Roles\Controllers\RoleController;

Route::middleware(['auth:admin', 'api'])->prefix('/api/roles/')->controller(RoleController::class)->group(function () {
    Route::get('get-all', 'getAll');

    Route::get('get-paginated-list', 'getPaginatedList');

    Route::post('store', 'store');

    Route::get('show/{id}', 'show');

    Route::post('update/{id}', 'update');

    Route::post('delete/{id}', 'destroy');

    Route::get('all-permissions', 'allPermissions');
});
