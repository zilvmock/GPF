<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Http\Livewire\Room\JoinRoom;
use App\Http\Livewire\Room\Main;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/browse', [BrowseController::class, 'showGames'])->name('browse');
    Route::get('/browse/{game:slug}/{id}/rooms', [BrowseController::class, 'showRooms'])->name('rooms');
    Route::get('/browse/{game:slug}/{id}/create-room', [RoomController::class, 'showCreateNewRoom'])->name('create_new_room');
    Route::get('/browse/{game:slug}/{id}/{room:id}', [RoomController::class, 'showRoom'])->name('show_room');

    Route::put('/store-room/{game:id}', [RoomController::class, 'storeCreatedRoom'])->name('store_new_room');
    Route::get('/join-room/{room:id}', [RoomController::class, 'joinRoom'])->name('join_room');
    Route::delete('/delete-room/{room:id}', [RoomController::class, 'deleteRoom'])->name('delete_room');
    Route::put('/leave-room/{room:id}', [RoomController::class, 'leaveRoom'])->name('leave_room');

    Route::put('/message-send/{room:id}', [MessageController::class, 'sendMessage'])->name('send_message');
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
