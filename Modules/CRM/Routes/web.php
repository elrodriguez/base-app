<?php

use Illuminate\Support\Facades\Route;
use Modules\CRM\Http\Controllers\CrmChatController;
use Modules\CRM\Http\Controllers\CrmContactsController;
use Modules\CRM\Http\Controllers\CRMController;

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

Route::middleware(['auth', 'verified'])->prefix('crm')->group(function () {
    Route::resource('crm', CRMController::class)->names('crm_dashboard');

    Route::middleware(['middleware' => 'permission:crm_contactos_listado'])
        ->get('contacts/list', [CrmContactsController::class, 'index'])
        ->name('crm_contacts_list');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->get('chat/dashboard', [CrmChatController::class, 'index'])
        ->name('crm_chat_dashboard');
});
