<?php

use App\Http\Controllers\LokasiController;
use App\Models\Lokasi;

Route::get('/', function () {
    $lokasi = Lokasi::all();
    return view('home', compact('lokasi'));
})->name('home');


Route::get('/lokasi-json', function () {
    return response()->json(App\Models\Lokasi::all());
});


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        $lokasi = Lokasi::all();
        return view('admin.index', compact('lokasi'));
    })->name('admin.index');
});

Route::prefix('admin')->group(function () {
    Route::resource('lokasi', LokasiController::class);
});

// Route::put('/admin/lokasi/update/{id_tempat}', [LokasiController::class, 'update'])->name('lokasi.update');
// Route::delete('/admin/lokasi/delete/{id_tempat}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');