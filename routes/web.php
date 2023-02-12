<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware('auth')->group(function () {
    Route::get('/',[ReservationController::class, 'index']);
    Route::get('/search',[ReservationController::class, 'search']);
    Route::post('/like/{shopId}',[ReservationController::class, 'like']);
    Route::post('/unlike/{shopId}',[ReservationController::class, 'unlike']);

    Route::get('/detail',[ReservationController::class, 'detail']);
    Route::post('/reservation',[ReservationController::class, 'reservation']);
    Route::get('/menu',[ReservationController::class, 'menu']);

    Route::get('/mypage',[ReservationController::class, 'mypage']);
    Route::post('/update/{id}',[ReservationController::class, 'update']);
    Route::post('/delete/{id}',[ReservationController::class, 'delete']);
    Route::post('/rate/{id}',[ReservationController::class, 'rate']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// 管理者用 画面
Route::get('/admin_register', [AdminController::class, 'admin_register']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
