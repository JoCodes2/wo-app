<?php

use App\Http\Controllers\CMS\AuthController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\GaleriController;
use App\Http\Controllers\CMS\KategoriController;
use App\Http\Controllers\CMS\LayananController;
use App\Http\Controllers\CMS\UserController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// ui
Route::get('/', function () {
    return view('web.beranda');
});

Route::get('/daftar-wo', function () {
    return view('web.daftar-wo');
});
// routes/web.php
Route::get('/profile-wo/{id}', function ($id) {
    return view('web.profile-wo', ['id' => $id]);
})->where('id', '[0-9a-fA-F-]{36}')->name('profile.wo');
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

// end ui


Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('wo/login', [AuthController::class, 'login']);


Route::middleware(['auth', 'web'])->group(function () {

    // user
    Route::get('/profile-saya', function () {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        return view('web.profile-saya', compact('user'));
    });
    // admin & wo
    // UI dashboard (data diambil dari endpoint /dashboard/admin-stats dan /dashboard/wo-stats)
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::get('/layanan', function () {
        return view('pages.layanan');
    });
    Route::get('/kategori', function () {
        return view('pages.kategori');
    });
    Route::get('/user', function () {
        return view('pages.user ');
    });

    // wo
    Route::get('/profile-wo', function () {
        $user = Auth::user();
        if (!$user) {
            return redirect('/login');
        }
        return view('pages.profile-wo', compact('user'));
    });

    Route::post('wo/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard stats routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/admin-stats', [DashboardController::class, 'adminStats']);
        Route::get('/wo-stats', [DashboardController::class, 'woStats']);
    });
});


Route::get('/galeri', function () {
    return view('pages.galeri');
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
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::post('/update/{id}', 'updateData');
        Route::delete('/delete/{id}', 'deleteData');
        Route::patch('/aktivasi/{id}', 'aktivasiAkunWo');
    });

    Route::prefix('galeri')->controller(GaleriController::class)->group(function () {
        Route::get('/', 'getAllData');
        Route::post('/create', 'createData');
        Route::get('/get/{id}', 'getDataById');
        Route::delete('/delete/{id}', 'deleteData');
    });
});
Route::prefix('landing')->controller(LandingPageController::class)->group(function () {
    Route::get('/wo', 'index');
    Route::get('/wo/categories', 'categories');
    Route::get('/wo/{id}', 'show');
    Route::get('/get-wo', 'getWo');
    Route::get('/top-wo', 'getTopWo');
});
