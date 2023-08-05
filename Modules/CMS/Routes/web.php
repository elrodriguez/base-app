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

use Modules\CMS\Http\Controllers\CmsPageController;

Route::middleware(['auth', 'verified'])->prefix('cms')->group(function () {
    Route::get('pages', [CmsPageController::class, 'index'])->name('cms_pages_list');
    Route::get('pages/create', [CmsPageController::class, 'create'])->name('cms_pages_create');
    Route::post('pages/store', [CmsPageController::class, 'store'])->name('cms_pages_store');
    Route::get('pages/edit/{id}', [CmsPageController::class, 'edit'])->name('cms_pages_edit');
    Route::put('pages/update/{id}', [CmsPageController::class, 'update'])->name('cms_pages_update');
    Route::delete('pages/destroy/{id}', [CmsPageController::class, 'destroy'])->name('cms_pages_destroy');
});
