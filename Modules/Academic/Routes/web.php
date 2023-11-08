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
    Route::get('institutions', 'AcaInstitutionController@index')->name('aca_institutions_list');
    Route::get('institutions/create', 'AcaInstitutionController@create')->name('aca_institutions_create');
    Route::post('institutions/store', 'AcaInstitutionController@store')->name('aca_institutions_store');
    Route::get('institutions/edit/{id}', 'AcaInstitutionController@edit')->name('aca_institutions_edit');
    Route::delete('institutions/destroy/{id}', 'AcaInstitutionController@destroy')->name('aca_institutions_destroy');
    Route::post('institutions/update', 'AcaInstitutionController@update')->name('aca_institutions_update');
    Route::get('students', 'AcaStudentController@index')->name('aca_students_list');
    Route::get('students/create', 'AcaStudentController@create')->name('aca_students_create');
    Route::post('students/store', 'AcaStudentController@store')->name('aca_students_store');
    Route::get('students/edit/{id}', 'AcaStudentController@edit')->name('aca_students_edit');
    Route::post('students/update', 'AcaStudentController@update')->name('aca_students_update');
    Route::get('courses', 'AcaCourseController@index')->name('aca_courses_list');
    Route::get('courses/edit/{id}', 'AcaCourseController@edit')->name('aca_courses_edit');
    Route::get('courses/information/{id}', 'AcaCourseController@information')->name('aca_courses_information');
    Route::get('agreement/list/{id}', 'AcaAgreementController@index')->name('aca_agreements_list');
    Route::delete('agreement/destroy/{id}', 'AcaAgreementController@destroy')->name('aca_agreements_destroy');
    Route::post('agreement/store', 'AcaAgreementController@store')->name('aca_agreements_store');

    Route::post('aca-upload-image', 'AcaBrochureController@uploadImage')->name('aca_upload_image_tiny');
});
