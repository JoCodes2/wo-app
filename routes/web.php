<?php

use App\Http\Controllers\CMS\KategoriController;
use App\Http\Controllers\CMS\LayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.kegiatan');
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
