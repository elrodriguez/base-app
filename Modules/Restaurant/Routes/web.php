<?php

use Illuminate\Support\Facades\Route;
use Modules\Restaurant\Http\Controllers\ResComandaController;
use Modules\Restaurant\Http\Controllers\ResPresentationController;

Route::middleware(['auth', 'verified'])->prefix('restaurant')->group(function () {

    Route::middleware(['middleware' => 'permission:res_comandas'])
        ->get('comandas', [ResComandaController::class, 'index'])
        ->name('res_comandas_list');
    Route::middleware(['middleware' => 'permission:res_comandas_nuevo'])
        ->get('comandas/create', [ResComandaController::class, 'create'])
        ->name('res_comandas_create');

    Route::middleware(['middleware' => 'permission:res_comandas_nuevo'])
        ->get('comandas/edit/{id}', [ResComandaController::class, 'edit'])
        ->name('res_comandas_edit');

    Route::middleware(['middleware' => 'permission:res_comandas'])
        ->get('presentations/category/{id}', [ResPresentationController::class, 'getByCategory'])
        ->name('res_presentation_by_cat_list');

    Route::post('comandas/store', [ResComandaController::class, 'store'])
        ->name('res_comandas_store');

    Route::post('comandas/update', [ResComandaController::class, 'update'])
        ->name('res_comandas_update');

    Route::delete('comandas/destroy/{id}', [ResComandaController::class, 'destroy'])
        ->name('res_comandas_destroy');
});
