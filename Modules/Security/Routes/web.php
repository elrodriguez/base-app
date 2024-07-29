<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Security\Http\Controllers\PermissionController;
use Modules\Security\Http\Controllers\RolesController;

Route::middleware('auth')->prefix('security')->group(function () {
    Route::get('dashboard', 'SecurityController@index')->name('security_dashboard');

    Route::get('profile', 'ProfileController@edit')->name('profile.edit');
    Route::post('profile', 'ProfileController@update')->name('profile.update');
    Route::delete('profile', 'ProfileController@destroy')->name('profile.destroy');

    Route::get('/config', function () {
        return Inertia::render('Security::Config');
    })->name('config');

    Route::resource('roles', RolesController::class);

    Route::resource('permissions', PermissionController::class);
    Route::get('destroy/permissions/{id}', 'PermissionController@destroy')->name('permissions_destroy');

    Route::get('table/permissions', 'PermissionController@getDataPermissions')->name('permissions_table');

    Route::post('person/information/update', [PersonController::class, 'createdOrUpdated'])->name('person_information_update');

    Route::get('dashboard/storage/indicator', 'SecurityController@storageIndicador')->name('security_storage_indicator');
});
