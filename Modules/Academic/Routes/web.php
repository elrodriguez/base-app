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

Route::middleware(['auth', 'verified'])->prefix('academic')->group(function () {
    Route::get('dashboard', 'AcademicController@index')->name('dashboard');
    Route::get('students', 'AcaStudentController@index')->name('aca_students_list');
    Route::get('students/create', 'AcaStudentController@create')->name('aca_students_create');
    Route::post('students/store', 'AcaStudentController@store')->name('aca_students_store');
    Route::get('students/edit/{id}', 'AcaStudentController@edit')->name('aca_students_edit');
    Route::post('students/update', 'AcaStudentController@update')->name('aca_students_update');
});
