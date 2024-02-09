<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController;

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

Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
Route::get('/messages/create', [MessagesController::class, 'create']);
Route::post('messages', [MessagesController::class, 'store']);
Route::get('/messages/excel', [MessagesController::class, 'excelAll']);

Route::get('messages/{messageId}', [MessagesController::class, 'show']);
Route::get('messagesOptional/{messageId}', [MessagesController::class, 'showOptional']);
Route::get('/messages/{messageId}/edit', [MessagesController::class, 'edit']);
Route::put('/messages/{messageId}', [MessagesController::class, 'update']);
