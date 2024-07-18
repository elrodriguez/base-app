<?php

use Illuminate\Support\Facades\Route;
use Modules\CRM\Http\Controllers\CrmChatController;
use Modules\CRM\Http\Controllers\CrmContactsController;
use Modules\CRM\Http\Controllers\CRMController;
use Modules\CRM\Http\Controllers\CrmMessagesController;

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
    Route::get('dashboard', [CRMController::class, 'index'])->name('crm_dashboard');

    Route::middleware(['middleware' => 'permission:crm_contactos_listado'])
        ->get('contacts/list', [CrmContactsController::class, 'index'])
        ->name('crm_contacts_list');

    Route::middleware(['middleware' => 'permission:crm_contactos_listado'])
        ->get('contacts/list/data', [CrmContactsController::class, 'getData'])
        ->name('crm_contacts_list_data');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->get('chat/dashboard', [CrmChatController::class, 'index'])
        ->name('crm_chat_dashboard');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->get('chat/contacts', [CrmChatController::class, 'getContacts'])
        ->name('crm_chat_contacts_data');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->post('conversations/messages', [CrmMessagesController::class, 'sendMessage'])
        ->name('crm_send_message');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->post('conversations/messages/list', [CrmMessagesController::class, 'getMessages'])
        ->name('crm_list_message');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->post('conversations/messages/upload/audio', [CrmMessagesController::class, 'uploadMessagesAudio'])
        ->name('crm_upload_message_audio');

    Route::middleware(['middleware' => 'permission:crm_chat_dashboard'])
        ->post('conversations/messages/delete/file', [CrmMessagesController::class, 'deleteFile'])
        ->name('crm_delete_message_file');
});
