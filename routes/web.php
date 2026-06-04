<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController; // <-- [1] Kenalkan PosSatpam dengan Manajer
use App\Http\Controllers\EventController;


Route::get('/', function () {
return view('home');

});
// [2] Jika ada yang akses URL /dashboard, arahkan ke EventControllerbagian index
Route::get('/dashboard', [CategoryController::class, 'index']);

// Jalur untuk menampilkan halaman input
Route::get('/dashboard/category/create', [CategoryController::class, 'create']);
// Jalur untuk memproses data yang dikirim dari form
Route::post('/dashboard/category/store', [CategoryController::class, 'store']);

Route::get('/kategori/{category}/edit', [CategoryController::class, 'edit']);
// Jalur untuk memproses penyimpanan data yang di-edit (Perhatikan method PUT)
Route::put('/kategori/{category}', [CategoryController::class, 'update']);
// Jalur untuk memproses penghapusan data (Perhatikan method DELETE)
Route::delete('/kategori/{category}', [CategoryController::class, 'destroy']);

// [2] Daftarkan jalurnya di bagian bawah file
Route::get('/event/create', [EventController::class, 'create']);
Route::post('/event/store', [EventController::class, 'store']);

Route::get('/events', [EventController::class, 'index']);

Route::get('/event/{event}/edit', [EventController::class, 'edit']);
Route::put('/event/{event}', [EventController::class, 'update']);
Route::delete('/event/{event}', [EventController::class, 'destroy']);

// Tambahkan di baris paling atas (di bawah use Illuminate...) 
use App\Http\Controllers\FrontEndController;  

// Jalur Publik: Halaman Depan Website (Landing Page) 
Route::get('/', [FrontEndController::class, 'index']); 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
