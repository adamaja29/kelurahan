<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\AuthController;


// Login Petugas
Route::get('/', function () {
    if (Auth::guard('web')->check()) {
        return redirect()->route(Auth::guard('web')->user()->role . '.dashboard');
    }

    if (Auth::guard('warga')->check()) {
        return redirect()->route('warga.dashboard');
    }

    return view('auth.login');
})->name('login');

Route::post('/prosesLoginPetugas', [AuthController::class, 'loginPetugas'])->name('prosesLoginPetugas');

// Login Warga
Route::get('/sekip', function () {
    if (Auth::guard('web')->check()) {
        return redirect()->route(Auth::guard('web')->user()->role . '.dashboard');
    }

    if (Auth::guard('warga')->check()) {
        return redirect()->route('warga.dashboard');
    }

    return view('auth.loginWarga');
})->name('warga.login');

Route::post('/prosesLoginWarga', [AuthController::class, 'loginWarga'])->name('prosesLoginWarga');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/logoutWarga', [AuthController::class, 'logoutWarga'])->name('logoutWarga');   



Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin/dashboard', [dashboardController::class, 'adminDashboard'])->name('admin.dashboard');
});

Route::middleware(['role:rw'])->group(function () {
    Route::get('/rw/dashboard', [dashboardController::class, 'rwDashboard'])->name('rw.dashboard');
});

Route::middleware(['role:rt'])->group(function () {
    Route::get('/rt/dashboard', [dashboardController::class, 'rtDashboard'])->name('rt.dashboard');
});

Route::middleware(['role:lurah'])->group(function () {
    Route::get('/lurah/dashboard', [dashboardController::class, 'lurahDashboard'])->name('lurah.dashboard');
});


Route::middleware('auth:warga')->group(function () {
    Route::get('/warga/dashboard', [dashboardController::class, 'wargaDashboard'])->name('warga.dashboard');
});



