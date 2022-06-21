<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KeanggotaanController;
use App\Http\Controllers\BebasPustakaController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\DashboardAuthorController;
use App\Http\Controllers\DashboardAnggotaController;
use App\Http\Controllers\DashboardContactController;
use App\Http\Controllers\DashboardKatalogController;
use App\Http\Controllers\DashboardPeminjamanController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
//Home-Sirkulasi 
Route::resource('/home/sirkulasi/peminjaman-buku', PeminjamanController::class)->except('show')->middleware('admin');
Route::resource('/home/sirkulasi/pengembalian-buku', PengembalianController::class)->except('show')->middleware('admin');
Route::get('/home/sirkulasi/penelusuran-katalog', [KatalogController::class, 'index']);
Route::get('/home/sirkulasi/penelusuran-katalog/detail/{katalog:slug}', [KatalogController::class, 'show']);
Route::get('/home/sirkulasi/penelusuran-katalog/{katalog:slug}', [KatalogController::class, 'pinjam']);
Route::resource('/home/sirkulasi/bebas-pustaka', BebasPustakaController::class)->except('show')->middleware('admin');
//Home-Layanan
Route::resource('/home/layanan/keanggotaan', KeanggotaanController::class)->except('show')->middleware('admin');
Route::get('/home/layanan/bibliography', function () {
    return view('home.layanan.bibliography', [
        "title" => "Layanan",
    ]);
});
Route::get('/home/layanan/bibliography/detil', function () {
    return view('home.detil.detil-bibliography', [
        "title" => "Layanan",
    ]);
});
//Home-Koleksi-Digital
Route::get('/home/koleksi-digital', function () {
    return view('home.koleksi-digital.koleksi-digital', [
        "title" => "Koleksi Digital",
    ]);
});
Route::get('/home/koleksi-digital/koleksi-digital/detil', function () {
    return view('home.detil-koleksi-digital', [
        "title" => "Koleksi Digital",
    ]);
});
//Contact
Route::get('/contact-us', [ContactController::class, 'showForm']);
Route::post('/contact-us', [ContactController::class, 'send'])->name('send.email');


//SIGN IN
Route::get('/sign-in', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/sign-in', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//SIGN UP
Route::get('/sign-up', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/sign-up', [RegisterController::class, 'store']);

//DASHBOARD

// Auth::routes();
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard.index', [
            'title' => 'Dashboard'
        ]);
    });

    //Penulis
    Route::get('/dashboard/authors/checkSlug', [DashboardAuthorController::class, 'checkSlug']);
    Route::resource('/dashboard/authors', DashboardAuthorController::class);
    
    //HERO
    Route::get('/dashboard/heroes/checkSlug', [HeroController::class, 'checkSlug']);
    Route::resource('/dashboard/heroes', HeroController::class);
    
    //Informasi
    Route::get('/dashboard/informasi/checkSlug', [InformasiController::class, 'checkSlug']);
    Route::resource('/dashboard/informasi', InformasiController::class);
    
    //Penelusuran Katalog
    Route::get('/dashboard/sirkulasi/katalogs/checkSlug', [DashboardKatalogController::class, 'checkSlug']);
    Route::resource('/dashboard/sirkulasi/katalogs', DashboardKatalogController::class);
    
    //Contact-us
    Route::get('/dashboard/contact-us', [DashboardContactController::class, 'index']);
    
    //Peminjaman
    Route::get('/dashboard/peminjamans/checkSlug', [DashboardPeminjamanController::class, 'checkSlug']);
    Route::resource('/dashboard/peminjamans', DashboardPeminjamanController::class);
});

//Anggota
// Route::get('/dashboard/authors/checkSlug', [DashboardAuthorController::class, 'checkSlug'])->middleware('auth');
// Route::resource('/dashboard/anggota', DashboardAnggotaController::class)->middleware('auth');


//ROLE ADMIN
// Route::resource('/home/sirkulasi/peminjaman-buku', AnggotaController::class)->except('show')->middleware('auth');