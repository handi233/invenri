<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route untuk aplikasi:
| - Login/logout
| - Halaman home (akses data stok)
| - Input data barang
| - Hapus data barang
|
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect('login');
});

// Route login
Route::get('/login', [LoginController::class, 'LoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Route logout
Route::post('/logout', function () {
    Auth::logout(); // Keluar dari auth guard
    request()->session()->invalidate(); // Hancurkan session
    request()->session()->regenerateToken(); // Regenerasi CSRF token

    return redirect('/login'); // Redirect ke login
})->name('logout');

// Group route yang harus login (middleware auth)
Route::middleware('auth')->group(function () {

    // Halaman home, menampilkan data stok
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    
    // Menyimpan data barang dari form input (POST) hal home
    Route::post('/home', [HomeController::class, 'baranginput'])->name('baranginput');

    // Menghapus barang berdasarkan id (DELETE) hal home
    Route::delete('/home/{id}', [HomeController::class, 'del'])->name('barang.del');

     // Menghapus barang berdasarkan id (DELETE) hal home
    Route::delete('/barang/{id}', [BarangMasukController::class, 'del'])->name('barangmasuk.del');

    // Menampilkan halaman formulir barang hal masuk
    Route::get('/barangmasuk', [BarangMasukController::class, 'index'])->name('barangmasuk');

    // Input halaman formulir barang hal masuk
    Route::post('/barangmasuk/input', [BarangMasukController::class, 'baranginput'])->name('baranginput.input');
    
   //AKSI FORM KELUAR

    //  Menampilkan halaman formulir barang keluar
    Route::get('/barangkeluar', [BarangKeluarController::class, 'index'])->name('barangkeluar');
     //  Menampilkan halaman formulir barang keluar
    Route::post('/barangkeluar', [BarangKeluarController::class, 'baranginput'])->name('barangkeluar.input');
     //  Menampilkan halaman formulir barang keluar
    Route::delete('/barangkeluar/{id}', [BarangKeluarController::class, 'del'])->name('barangkeluar.del');

    //AKSI PENGGUNA

    //Menampilkan From User pengguna
     Route::get('/users', [UsersController::class, 'index'])->name('users');
     
    //Input From User pengguna
     Route::post('/users', [UsersController::class, 'input'])->name('users.input');

    //Hapus From User pengguna
     Route::delete('/users/{id}', [UsersController::class, 'del'])->name('users.del');
 
     // Edit P      engguna
    Route::put('/users/update-password', [UsersController::class, 'updatePassword'])->name('users.updatePassword');

     //AKSI SETINGS

    //Menampilkan From Settings
     Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

      //Edit From User pengguna
     Route::put('/settings/{id}', [SettingsController::class, 'update'])->name('settings.update');

    //Hapus From User pengguna
     Route::delete('/settings/{id}', [SettingsController::class, 'del'])->name('settings.del');

     //Menampilkan From User pengguna
     Route::get('/help', [HelpController::class, 'index'])->name('help'); 
});


