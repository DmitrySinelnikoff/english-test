<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::name('main.')->group(function() {
    Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('index');
});

Route::prefix('words')->name('word.')->group(function() {
    Route::get('/', [App\Http\Controllers\WordController::class, 'index'])->name('index');
    Route::get('/{word}', [App\Http\Controllers\WordController::class, 'show'])->name('show');
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
    Route::get('/{tag}', [App\Http\Controllers\TagController::class, 'show'])->name('show');
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