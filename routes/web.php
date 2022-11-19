<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/upload', [UploadController::class, 'store']);

Route::middleware(['auth', 'verified', 'noPendingVerify'])->group(function () {
    Route::get('/browse', [BrowseController::class, 'showGames'])->name('browse');
    Route::get('/browse/{game:slug}/{id}/rooms', [BrowseController::class, 'showRooms'])->name('rooms');
    Route::get('/browse/{game:slug}/{id}/create-room', [RoomController::class, 'showCreateNewRoom'])->name('create_new_room');
    Route::get('/browse/{game:slug}/{id}/{room:id}', [RoomController::class, 'showRoom'])->name('show_room');

    Route::put('/store-room/{game:id}', [RoomController::class, 'storeCreatedRoom'])->name('store_new_room');
    Route::get('/join-room/{room:id}', [RoomController::class, 'joinRoom'])->name('join_room');
    Route::delete('/delete-room/{room:id}', [RoomController::class, 'deleteRoom'])->name('delete_room');
    Route::put('/leave-room/{room:id}', [RoomController::class, 'leaveRoom'])->name('leave_room');
    Route::put('/lock-room/{room:id}', [RoomController::class, 'lockRoom'])->name('lock_room');
    Route::put('/kick-from-room/{room:id}/{user:id}', [RoomController::class, 'kickFromRoom'])->name('kick_from_room');

    Route::put('/message-send/{room:id}', [MessageController::class, 'sendMessage'])->name('send_message');

    Route::get('/profile/edit', [ProfileController::class, 'showEditProfile'])->name('edit_profile');
    Route::put('/profile/edit/store', [ProfileController::class, 'updateProfile'])->name('store_profile');
    Route::put('/profile/edit/storeAcc', [ProfileController::class, 'updateProfileAccounts'])->name('store_profile_acc');
    Route::get('/profile/{user:username}', [ProfileController::class, 'showProfile'])->name('show_profile');
});


// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
