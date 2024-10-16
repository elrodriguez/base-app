<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Modules\Dental\Http\Controllers\AppointmentController;
use Modules\Dental\Http\Controllers\DentAttentionController;

Route::middleware(['auth', 'verified'])->prefix('dental')->group(function () {
    Route::get('/', 'DentalController@index')->name('dental_dashboard');

    ///////odontologico/////////
    Route::get('appointments/calendar', [AppointmentController::class, 'calendar'])->name('odontology_appointments_calendar');
    Route::get('appointments/list', [AppointmentController::class, 'index'])->name('odontology_appointments_list');
    Route::post('appointments/store', [AppointmentController::class, 'store'])->name('odontology_appointments_store');
    Route::put('appointments/update/{id}', [AppointmentController::class, 'update'])->name('odontology_appointments_update');
    Route::put('appointments/update_status/{id}', [AppointmentController::class, 'updateStatus'])->name('odontology_appointments_update_status');
    Route::put('appointments/update_important/{id}', [AppointmentController::class, 'updateImportant'])->name('odontology_appointments_update_important');
    Route::delete('appointments/destroy/{id}', [AppointmentController::class, 'destroy'])->name('odontology_appointments_destroy');
    Route::get('event/appointments', [AppointmentController::class, 'getDentAppointments'])->name('dental_event_appointments');
    Route::get('appointments/hours/{date}/{doctor}/busy', [AppointmentController::class, 'getBusyHours'])->name('odontology_appointments_busy_hours');
    Route::get('attention/list', [DentAttentionController::class, 'index'])->name('odontology_attention_list');
    Route::get('attention/table', [DentAttentionController::class, 'getTable'])->name('odontology_attention_table');
    Route::get('attention/create', [DentAttentionController::class, 'create'])->name('odontology_attention_create');
});
