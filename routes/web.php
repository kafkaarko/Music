<?php

use App\Http\Controllers\AkunController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\landingController;
use App\Http\Middleware\IsGuest;
use App\Http\Middleware\IsLogin;


Route::middleware([IsGuest::class])->group(function (){
    Route::get('/', [AkunController::class, 'login'])->name('login');
    Route::post('/login', [AkunController::class, 'loginAuth'])->name('login.auth');
    
});

Route::middleware([IsLogin::class])->group(function(){


Route::post('/logout', [AkunController::class, 'logout'])->name('logout');


Route::get('/landing', [landingController::class, 'index'])->name('landing');

Route::prefix('/music')->name('music.')->group(function(){
    Route::get('/song', [MusicController::class,'index'])->name('home');
    Route::get('/tambah', [MusicController::class,'create'])->name('create');
    Route::post('/tambah-song', [MusicController::class,'store'])->name('store');
    Route::get('/edit/{id}', [MusicController::class,'edit'])->name('edit');
    Route::patch('/edit/lagu/{id}', [MusicController::class,'update'])->name('update');
    Route::patch('/edit/lagu/{id}', [MusicController::class,'update'])->name('update');
    Route::delete('/{id}', [MusicController::class,'destroy'])->name('destroy');
});

Route::resource('/akun', AkunController::class)->names([
    'index' => 'akun.index',
    'create' => 'akun.create',
    'store' => 'akun.store',
    'edit' => 'akun.edit',
    'update' => 'akun.update',
    'destroy' => 'akun.destroy',
]);

});