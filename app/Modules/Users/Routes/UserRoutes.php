<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\UserController;

Route::middleware(['auth:admin', 'api'])->prefix('/api/users/')->controller(UserController::class)->group(function () {
    Route::get('get-all', 'getAll');

    Route::get('get-paginated-list', 'getPaginatedList');

    Route::post('store', 'store');

    Route::get('show/{id}', 'show');

    Route::post('update/{id}', 'update');

    Route::post('delete/{id}', 'destroy');

    Route::get('get-status', 'getStatus');

    Route::get('get-genders', 'getGenders');
});
