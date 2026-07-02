<?php

use App\Http\Controllers\adminController;
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

    Route::get('/admin/data-warga', [adminController::class, 'dataWarga'])->name('admin.dataWarga');
    Route::get('/admin/data-rt', [adminController::class, 'dataRT'])->name('admin.dataRT');
    Route::get('/admin/data-rw', [adminController::class, 'dataRW'])->name('admin.dataRW');
    Route::get('/admin/data-lurah', [adminController::class, 'dataLurah'])->name('admin.dataLurah');

    // CRUD User RT
    Route::get('/admin/rt/create', [adminController::class, 'createRTUser'])->name('admin.rt.create');
    Route::post('/admin/rt', [adminController::class, 'storeRTUser'])->name('admin.rt.store');
    Route::get('/admin/rt/{user}/edit', [adminController::class, 'editRTUser'])->name('admin.rt.edit');
    Route::put('/admin/rt/{user}', [adminController::class, 'updateRTUser'])->name('admin.rt.update');
    Route::delete('/admin/rt/{user}', [adminController::class, 'deleteRTUser'])->name('admin.rt.delete');

    Route::get('/admin/user/{user}/edit', [adminController::class, 'editUser'])->name('admin.user.edit');
    Route::delete('/admin/user/{user}', [adminController::class, 'deleteUser'])->name('admin.user.delete');

    Route::get('/admin/data-warga/{warga}/edit', [adminController::class, 'editWarga'])->name('admin.warga.edit');
    Route::put('/admin/data-warga/{warga}', [adminController::class, 'updateWarga'])->name('admin.warga.update');
    Route::delete('/admin/data-warga/{warga}', [adminController::class, 'deleteWarga'])->name('admin.warga.delete');

    Route::get('/admin/rw/create', [adminController::class, 'createRWUser'])->name('admin.rw.create');
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    Route::get('/admin/wilayah/rt', [adminController::class, 'dataWilayahRT'])->name('admin.wilayah.rt');
    Route::get('/admin/wilayah/rw', [adminController::class, 'dataWilayahRW'])->name('admin.wilayah.rw');

    // CRUD Wilayah RT
    Route::get('/admin/wilayah/rt/{rtModel}/edit', [adminController::class, 'editWilayahRT'])->name('admin.wilayah.rt.edit');
    Route::put('/admin/wilayah/rt/{rtModel}', [adminController::class, 'updateWilayahRT'])->name('admin.wilayah.rt.update');
    Route::delete('/admin/wilayah/rt/{rtModel}', [adminController::class, 'deleteWilayahRT'])->name('admin.wilayah.rt.delete');

    // CRUD Wilayah RW
    Route::get('/admin/wilayah/rw/{rwModel}/edit', [adminController::class, 'editWilayahRW'])->name('admin.wilayah.rw.edit');
    Route::put('/admin/wilayah/rw/{rwModel}', [adminController::class, 'updateWilayahRW'])->name('admin.wilayah.rw.update');
    Route::delete('/admin/wilayah/rw/{rwModel}', [adminController::class, 'deleteWilayahRW'])->name('admin.wilayah.rw.delete');

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



