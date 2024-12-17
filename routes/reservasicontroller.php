<?php

use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Route;
use App\Models\Reservasi;
use Inertia\Inertia;


Route::get('/reservasis', [ReservasiController::class, 'index'])->name('reservasis.index'); // Menampilkan daftar reservasi
Route::post('/submit-reservasi', [ReservasiController::class, 'store'])->name('reservasis.store'); // Menyimpan data reservasi baru
Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('reservasis.show'); // Menampilkan detail reservasi
Route::delete('/reservasi/{id}', [ReservasiController::class, 'destroy'])->name('reservasis.destroy'); // Menghapus data reservasi
// Rute pembayaran
Route::get('/pembayaran/{id}', function ($id) {
    return Inertia::render('PembayaranView', ['id' => $id]);
})->name('pembayaran.view');
