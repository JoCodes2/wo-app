<?php

use App\Http\Controllers\CMS\KategoriController;
use App\Http\Controllers\CMS\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.beranda');
});

Route::get('/daftar-wo', function () {
    return view('web.daftar-wo');
});
Route::get('/profile-wo/{id}', function () {
    return view('web.profile-wo');
});
Route::get('/profile-saya', function () {
    return view('web.profile-saya');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/kategori', function () {
    return view('pages.kategori');
});

Route::get('/layanan', function () {
    return view('pages.layanan');
});

Route::prefix('wo')->group(function () {
    Route::prefix('layanan')->controller(LayananController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });

    Route::prefix('kategori')->controller(KategoriController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
    });
});
