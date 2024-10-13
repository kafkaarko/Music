<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\landingController;

Route::get('/', [landingController::class, 'index']);

Route::prefix('/music')->name('music.')->group(function(){
    Route::get('/song', [MusicController::class,'index'])->name('home');
    Route::get('/tambah', [MusicController::class,'create'])->name('create');
    Route::post('/tambah-song', [MusicController::class,'store'])->name('store');
    Route::get('/edit/{id}', [MusicController::class,'edit'])->name('edit');
    Route::patch('/edit/lagu/{id}', [MusicController::class,'update'])->name('update');
    Route::patch('/edit/lagu/{id}', [MusicController::class,'update'])->name('update');
    Route::delete('/{id}', [MusicController::class,'destroy'])->name('destroy');
});