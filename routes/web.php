<?php

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
