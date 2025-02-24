<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::name('main.')->group(function() {
    Route::get('/', [App\Http\Controllers\Main\IndexController::class, 'index'])->name('index');
});

Route::prefix('words')->name('word.')->group(function() {
    Route::get('/', [App\Http\Controllers\Word\IndexController::class, 'index'])->name('index');
    Route::get('/{word}', [App\Http\Controllers\Word\ShowController::class, 'index'])->name('show');
    Route::delete('/{word}', [App\Http\Controllers\Word\DeleteController::class, 'index'])->name('delete');

});

Route::prefix('suggest')->name('suggest.')->group(function() {
    Route::get('/', [App\Http\Controllers\Suggest\IndexController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\Suggest\CreateController::class, 'index'])->name('create')->middleware('auth');
    Route::post('/', [App\Http\Controllers\Suggest\StoreController::class, 'index'])->name('store');
    Route::delete('/{word}', [App\Http\Controllers\Suggest\DeleteController::class, 'index'])->name('delete');
    Route::patch('/approved/{word}', [App\Http\Controllers\Suggest\ApprovedController::class, 'index'])->name('approved');
});

Route::prefix('tags')->name('tags.')->group(function() {
    Route::get('/', [App\Http\Controllers\Tags\IndexController::class, 'index'])->name('index');
    Route::get('/{tag}', [App\Http\Controllers\Tags\ShowController::class, 'index'])->name('show');
});

Route::middleware('auth')->group(function() {
    Route::prefix('wordtest')->name('wordtest.')->group(function() {
        Route::post('/test', [App\Http\Controllers\WordTest\IndexController::class, 'index'])->name('index');
        Route::get('/show/{test}/{index}', [App\Http\Controllers\WordTest\ShowController::class, 'index'])->name('show');
        Route::get('/list', [App\Http\Controllers\WordTest\ListController::class, 'index'])->name('list');
        Route::post('/check', [App\Http\Controllers\WordTest\CheckController::class, 'index'])->name('check');
        Route::get('/result/{test}', [App\Http\Controllers\WordTest\ResultController::class, 'index'])->name('result');
    });
});

Route::middleware('auth')->group(function() {
    Route::prefix('transcriptiontest')->name('transcriptiontest.')->group(function() {
        Route::post('/test', [App\Http\Controllers\TranscriptionTest\IndexController::class, 'index'])->name('index');
        Route::get('/show/{test}/{index}', [App\Http\Controllers\TranscriptionTest\ShowController::class, 'index'])->name('show');
        // Route::get('/list', [App\Http\Controllers\WordTest\ListController::class, 'index'])->name('list');
        // Route::post('/check', [App\Http\Controllers\WordTest\CheckController::class, 'index'])->name('check');
        // Route::get('/result/{test}', [App\Http\Controllers\WordTest\ResultController::class, 'index'])->name('result');
    });
});

Route::prefix('search')->name('search.')->group(function() {
    Route::post('/', [App\Http\Controllers\Search\IndexController::class,'index'])->name('index');
});