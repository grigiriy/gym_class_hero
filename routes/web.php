<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Controller::class,'showLoginForm'])->name('login');
Route::get('/register', [Controller::class,'showRegisterForm'])->name('register');


Route::post('/signup', [Controller::class,'showRegisterForm'])->name('signup');

