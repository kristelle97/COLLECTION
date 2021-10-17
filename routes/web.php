<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ItemController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/index', [CollectionController::class,'display_collections'])->name('index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [CollectionController::class,'index'])->name('dashboard');

    Route::group(['prefix' => 'collection', 'as' => 'collection.'], function () {
        Route::post('/', [CollectionController::class,'store'])->name('store');
        Route::delete('/{collectionId}', [CollectionController::class,'destroy'])->name('destroy');
        Route::get('/{collectionId}', [CollectionController::class, 'edit'])->name('edit');
        Route::put('/{collectionId}', [CollectionController::class,'update'])->name('update');
        Route::post('/{collectionId}', [CollectionController::class,'toggle_like'])->name('like');

        Route::group(['prefix' => '{collectionId}/item', 'as' => 'item.'], function () {
            Route::post('/', [ItemController::class,'store'])->name('store');
            Route::delete('/{itemId}', [ItemController::class,'destroy'])->name('destroy');
            Route::get('/list', [ItemController::class,'index'])->name('index');
            Route::get('/{itemId}', [ItemController::class,'edit'])->name('edit');
            Route::put('/{itemId}', [ItemController::class,'update'])->name('update');
            Route::post('/{itemId}/like', [ItemController::class,'toggle_like'])->name('like');
      });

  });

  Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/profile', [RegisteredUserController::class,'edit'])->name('edit');
    Route::post('/profile', [RegisteredUserController::class,'update'])->name('update');
    });

});

require __DIR__.'/auth.php';
