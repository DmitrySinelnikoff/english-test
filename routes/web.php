<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::name('main.')->group(function() {
    Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');
});

Route::prefix('users')->name('user.')->group(function(){
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
    Route::get('show/{user}', [App\Http\Controllers\UserController::class, 'show'])->name('show');
    Route::get('/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edit');
    Route::patch('/', [App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::delete('/', [App\Http\Controllers\UserController::class, 'destroy'])->name('delete');
});

Route::prefix('words')->name('word.')->group(function() {
    Route::get('/', [App\Http\Controllers\WordController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\WordController::class, 'create'])->name('create')->middleware('auth', 'admin');
    Route::post('/store', [App\Http\Controllers\WordController::class, 'store'])->name('store')->middleware('auth', 'admin');
    Route::get('/{word}', [App\Http\Controllers\WordController::class, 'show'])->name('show');
    Route::get('/edit/{word}', [App\Http\Controllers\WordController::class, 'edit'])->name('edit');
    Route::patch('/{word}', [App\Http\Controllers\WordController::class, 'update'])->name('update');
    Route::delete('/{word}', [App\Http\Controllers\WordController::class, 'destroy'])->name('delete');
});

Route::prefix('suggest')->name('suggest.')->group(function() {
    Route::get('/', [App\Http\Controllers\SuggestController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\SuggestController::class, 'create'])->name('create')->middleware('auth');
    Route::post('/', [App\Http\Controllers\SuggestController::class, 'store'])->name('store');
    Route::delete('/{word}', [App\Http\Controllers\SuggestController::class, 'destroy'])->name('delete');
    Route::patch('/approved/{word}', [App\Http\Controllers\SuggestController::class, 'approved'])->name('approved');
});

Route::prefix('tags')->name('tags.')->group(function() {
    Route::get('/', [App\Http\Controllers\TagController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\TagController::class, 'create'])->name('create')->middleware('auth', 'admin');
    Route::post('/store', [App\Http\Controllers\TagController::class, 'store'])->name('store')->middleware('auth', 'admin');
    Route::get('/{tag}', [App\Http\Controllers\TagController::class, 'show'])->name('show');
    Route::get('/edit/{tag}', [App\Http\Controllers\TagController::class, 'edit'])->name('edit')->middleware('auth', 'admin');
    Route::patch('/{tag}', [App\Http\Controllers\TagController::class, 'update'])->name('update')->middleware('auth', 'admin');
    Route::delete('/{tag}', [App\Http\Controllers\TagController::class, 'destroy'])->name('delete')->middleware('auth', 'admin');
});

Route::middleware('auth')->group(function() {
    Route::prefix('wordtest')->name('wordtest.')->group(function() {
        Route::post('/test', [App\Http\Controllers\WordTestController::class, 'index'])->name('index');
        Route::get('/show/{test}/{index}', [App\Http\Controllers\WordTestController::class, 'show'])->name('show');
        Route::get('/list', [App\Http\Controllers\WordTestController::class, 'list'])->name('list');
        Route::post('/check', [App\Http\Controllers\WordTestController::class, 'check'])->name('check');
        Route::get('/result/{test}', [App\Http\Controllers\WordTestController::class, 'result'])->name('result');
    });
});

Route::prefix('search')->name('search.')->group(function() {
    Route::post('/', [App\Http\Controllers\SearchController::class,'index'])->name('index');
});

Route::prefix('statistics')->name('statistics.')->group(function() {
    Route::get('/', [App\Http\Controllers\StatisticsController::class, 'index'])->name('index');
});