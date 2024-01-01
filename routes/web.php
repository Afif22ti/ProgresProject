<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\TestimoniController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template.master');
});

Route::get('/testimoni/tentang', [TestimoniController::class, 'tentang'])->name('testimoni.tentang');
Route::redirect('/', '/dashboard');
Route::get('/testimoni/cards', [TestimoniController::class, 'showCards'])->name('testimoni.cards');
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni.index');
Route::get('/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
Route::delete('/testimoni/{id}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
Route::put('/testimoni/{id}', [TestimoniController::class, 'update'])->name('testimoni.update');
Route::get('/testimoni/{id}', [TestimoniController::class, 'show'])->name('testimoni.show');

Route::get('/user', [MobilController::class, 'user'])->name('mobil.user');
Route::get('/dashboard', [MobilController::class, 'dashboard'])->name('mobil.dashboard');
Route::get('/mobil/cards', [MobilController::class, 'showCards'])->name('mobil.cards');
Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
Route::get('/mobil/create', [MobilController::class, 'create'])->name('mobil.create');
Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');
Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
Route::delete('/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');
Route::get('/mobil/{id}', [MobilController::class, 'show'])->name('mobil.show');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['Middleware' => ['auth']], function(){

    

});
