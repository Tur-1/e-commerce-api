<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users\Controllers\UserController;

Route::middleware(['api'])->prefix('/api')->controller(UserController::class)->group(function () {
    Route::get('/users/get-all', 'getAll');
    Route::get('/users/get-paginated-list', 'getPaginatedList');
    Route::post('/users/store', 'store');
    Route::post('/users/show/{id}', 'show');
    Route::post('/users/update/{id}', 'update');
    Route::post('/users/delete/{id}', 'destroy');
});
