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
    Route::middleware(['middleware' => 'permission:aca_dashboard'])
        ->get('dashboard', 'AcademicController@index')
        ->name('dashboard');

    Route::middleware(['middleware' => 'permission:aca_institucion_listado'])
        ->get('institutions', 'AcaInstitutionController@index')
        ->name('aca_institutions_list');

    Route::middleware(['middleware' => 'permission:aca_institucion_nuevo'])
        ->get('institutions/create', 'AcaInstitutionController@create')
        ->name('aca_institutions_create');

    Route::post('institutions/store', 'AcaInstitutionController@store')->name('aca_institutions_store');
    Route::middleware(['middleware' => 'permission:aca_institucion_editar'])
        ->get('institutions/edit/{id}', 'AcaInstitutionController@edit')
        ->name('aca_institutions_edit');

    Route::middleware(['middleware' => 'permission:aca_institucion_eliminar'])
        ->delete('institutions/destroy/{id}', 'AcaInstitutionController@destroy')
        ->name('aca_institutions_destroy');

    Route::post('institutions/update', 'AcaInstitutionController@update')->name('aca_institutions_update');
    Route::middleware(['middleware' => 'permission:aca_docente_listado'])
        ->get('teachers', 'AcaTeacherController@index')
        ->name('aca_teachers_list');

    Route::middleware(['middleware' => 'permission:aca_docente_nuevo'])
        ->get('teachers/create', 'AcaTeacherController@create')
        ->name('aca_teachers_create');

    Route::middleware(['middleware' => 'permission:aca_docente_editar'])
        ->get('teachers/edit/{id}', 'AcaTeacherController@edit')
        ->name('aca_teachers_edit');

    Route::post('teachers/store', 'AcaTeacherController@store')->name('aca_teachers_store');
    Route::post('teachers/update', 'AcaTeacherController@update')->name('aca_teachers_update');
    Route::middleware(['middleware' => 'permission:aca_docente_eliminar'])
        ->delete('teachers/destroy/{id}', 'AcaTeacherController@destroy')
        ->name('aca_teachers_destroy');

    Route::get('teachers/resume/{id}', 'AcaTeacherController@resume')->name('aca_teachers_resume');
    Route::post('teachers/resume/work_experience/store', 'AcaTeacherController@workExperienceStore')->name('aca_teachers_work_experience_store');
    Route::delete('teachers/resume/work_experience/destroy/{id}', 'AcaTeacherController@workExperienceDestroy')->name('aca_teachers_work_experience_destroy');
    Route::middleware(['middleware' => 'permission:aca_estudiante_listado'])
        ->get('students', 'AcaStudentController@index')
        ->name('aca_students_list');

    Route::middleware(['middleware' => 'permission:aca_estudiante_nuevo'])
        ->get('students/create', 'AcaStudentController@create')
        ->name('aca_students_create');

    Route::post('students/store', 'AcaStudentController@store')
        ->name('aca_students_store');

    Route::middleware(['middleware' => 'permission:aca_estudiante_editar'])
        ->get('students/edit/{id}', 'AcaStudentController@edit')
        ->name('aca_students_edit');

    Route::post('students/update', 'AcaStudentController@update')->name('aca_students_update');

    Route::middleware(['middleware' => 'permission:aca_cursos_listado'])
        ->get('courses', 'AcaCourseController@index')
        ->name('aca_courses_list');

    Route::middleware(['middleware' => 'permission:aca_cursos_nuevo'])
        ->get('courses/create', 'AcaCourseController@create')
        ->name('aca_courses_create');
    Route::post('courses/store', 'AcaCourseController@store')->name('aca_courses_store');

    Route::middleware(['middleware' => 'permission:aca_cursos_editar'])
        ->get('courses/edit/{id}', 'AcaCourseController@edit')
        ->name('aca_courses_edit');

    Route::post('courses/update', 'AcaCourseController@update')->name('aca_courses_update');

    Route::middleware(['middleware' => 'permission:aca_cursos_eliminar'])
        ->delete('courses/destroy/{id}', 'AcaCourseController@destroy')
        ->name('aca_courses_destroy');

    Route::middleware(['middleware' => 'permission:aca_cursos_listado'])
        ->get('courses/information/{id}', 'AcaCourseController@information')
        ->name('aca_courses_information');

    Route::middleware(['middleware' => 'permission:aca_cursos_listado'])
        ->get('agreement/list/{id}', 'AcaAgreementController@index')
        ->name('aca_agreements_list');

    Route::middleware(['middleware' => 'permission:aca_cursos_listado'])
        ->delete('agreement/destroy/{id}', 'AcaAgreementController@destroy')
        ->name('aca_agreements_destroy');

    Route::post('agreement/store', 'AcaAgreementController@store')->name('aca_agreements_store');
    Route::post('brochure/store', 'AcaBrochureController@store')->name('aca_brochure_store');
    Route::post('aca-upload-image', 'AcaBrochureController@uploadImage')->name('aca_upload_image_tiny');
});
