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

use Modules\CMS\Http\Controllers\CmsItemController;
use Modules\CMS\Http\Controllers\CmsPageController;
use Modules\CMS\Http\Controllers\CmsPageSectionController;
use Modules\CMS\Http\Controllers\CmsSectionController;
use Modules\CMS\Http\Controllers\CmsSectionItemController;

Route::middleware(['auth', 'verified'])->prefix('cms')->group(function () {
    Route::get('pages', [CmsPageController::class, 'index'])->name('cms_pages_list');
    Route::get('pages/create', [CmsPageController::class, 'create'])->name('cms_pages_create');
    Route::post('pages/store', [CmsPageController::class, 'store'])->name('cms_pages_store');
    Route::get('pages/edit/{id}', [CmsPageController::class, 'edit'])->name('cms_pages_edit');
    Route::put('pages/update/{id}', [CmsPageController::class, 'update'])->name('cms_pages_update');
    Route::delete('pages/destroy/{id}', [CmsPageController::class, 'destroy'])->name('cms_pages_destroy');

    Route::get('pages/sections/{id}', [CmsPageSectionController::class, 'index'])->name('cms_pages_section_list');
    Route::post('pages/sections/add', [CmsPageSectionController::class, 'store'])->name('cms_pages_section_add');
    Route::get('pages/section_item_data/{id}', [CmsPageSectionController::class, 'getSectionItems'])->name('cms_pages_section_items_data');
    Route::post('pages/section_item_data_save', [CmsPageSectionController::class, 'updateItems'])->name('cms_pages_section_items_save');
    Route::delete('pages/section_item_data_delete/{id}', [CmsPageSectionController::class, 'destroySection'])->name('cms_pages_section_items_delete');

    Route::get('sections', [CmsSectionController::class, 'index'])->name('cms_section_list');
    Route::get('sections/create', [CmsSectionController::class, 'create'])->name('cms_section_create');
    Route::post('sections/store', [CmsSectionController::class, 'store'])->name('cms_section_store');
    Route::get('sections/edit/{id}', [CmsSectionController::class, 'edit'])->name('cms_section_edit');
    Route::put('sections/update/{id}', [CmsSectionController::class, 'update'])->name('cms_section_update');
    Route::delete('sections/destroy/{id}', [CmsSectionController::class, 'destroy'])->name('cms_section_destroy');


    Route::get('sections/items/{id}', [CmsSectionItemController::class, 'index'])->name('cms_section_items');
    Route::post('sections/items/store', [CmsSectionItemController::class, 'store'])->name('cms_section_items_store');
    Route::delete('sections/items/destroy/{id}', [CmsSectionItemController::class, 'destroy'])->name('cms_section_items_destroy');

    Route::get('items', [CmsItemController::class, 'index'])->name('cms_items_list');
    Route::get('items/create', [CmsItemController::class, 'create'])->name('cms_items_create');
    Route::post('items/store', [CmsItemController::class, 'store'])->name('cms_items_store');
    Route::get('items/edit/{id}', [CmsItemController::class, 'edit'])->name('cms_items_edit');
    Route::post('items/update', [CmsItemController::class, 'update'])->name('cms_items_update');
    Route::delete('items/destroy/{id}', [CmsItemController::class, 'destroy'])->name('cms_items_destroy');
});
