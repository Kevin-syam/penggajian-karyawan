<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'reset' => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/absen-pulang', [App\Http\Controllers\HomeController::class, 'absen_pulang']);
    Route::post('/cetak-gaji', [App\Http\Controllers\HomeController::class, 'cetak_gaji']);
    Route::resource('/profile', App\Http\Controllers\ProfileController::class)
        ->only(['index', 'store']);
    Route::resource('/departemen', App\Http\Controllers\DepartemenController::class)
        ->except(['show']);
    Route::resource('/pegawai', App\Http\Controllers\PegawaiController::class)
        ->except(['show']);
    Route::resource('/absen', App\Http\Controllers\AbsenController::class)
        ->only(['index', 'create', 'store']);
    Route::resource('/gaji', App\Http\Controllers\GajiController::class)
        ->except(['show']);
    Route::resource('/jenis-cuti', App\Http\Controllers\CutiController::class)
        ->except(['show']);
    Route::resource('/pengajuan-cuti', App\Http\Controllers\PengajuanCutiController::class)
        ->except(['show']);
    });
    
    // Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');