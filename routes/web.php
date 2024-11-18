<?php

use App\Http\Controllers\BeritaTerkiniController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KabupatenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PariwisataController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Models\Event;
use App\Models\BeritaTerkini;
use App\Models\Pariwisata;
use App\Models\Kuliner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/front', [FrontController::class, 'index'])->name('front.index');
Route::get('/front/detail', [FrontController::class, 'detailView'])->name('front.detail');

Route::get('/detail/{tipe}/{id}', [FrontController::class, 'detailShow'])->name('detail.show');

Route::get('/', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Kabupaten
    Route::get('/admin/kabupaten/index', [KabupatenController::class, 'index'])->name('kabupaten.index');
    Route::get('/admin/kabupaten/data', [KabupatenController::class, 'getKabupatenData'])->name('kabupaten.getData');
    Route::get('/admin/kabupaten/create', [KabupatenController::class, 'create'])->name('kabupaten.create');
    Route::get('/admin/kabupaten/{id}/edit', [KabupatenController::class, 'edit'])->name('kabupaten.edit');
    Route::post('admin/kabupaten', [KabupatenController::class, 'store'])->name('kabupaten.store');
    Route::put('/admin/kabupaten/{id}', [KabupatenController::class, 'update'])->name('kabupaten.update');
    Route::delete('kabupaten/{id}', [KabupatenController::class, 'destroy'])->name('kabupaten.delete');

    // Pariwisata
    Route::get('/admin/pariwisata/index', [PariwisataController::class, 'index'])->name('pariwisata.index');
    Route::get('/admin/pariwisata/data', [PariwisataController::class, 'getPariwisataData'])->name('pariwisata.getData');
    Route::get('/admin/pariwisata/create', [PariwisataController::class, 'create'])->name('pariwisata.create');
    Route::get('/admin/pariwisata/{id}/edit', [PariwisataController::class, 'edit'])->name('pariwisata.edit');
    Route::post('admin/pariwisata', [PariwisataController::class, 'store'])->name('pariwisata.store');
    Route::post('/admin/pariwisata', [PariwisataController::class, 'store'])->name('pariwisata.store');
    Route::post('/admin/pariwisata/update/{id}', [PariwisataController::class, 'update'])->name('pariwisata.update');
    Route::delete('pariwisata/{id}', [PariwisataController::class, 'destroy'])->name('pariwisata.destroy');

    // Kuliner
    Route::get('/admin/kuliner/index', [KulinerController::class, 'index'])->name('kuliner.index');
    Route::get('/admin/kuliner/data', [KulinerController::class, 'getKulinerData'])->name('kuliner.getData');
    Route::get('/admin/kuliner/create', [KulinerController::class, 'create'])->name('kuliner.create');
    Route::get('/admin/kuliner/{id}/edit', [KulinerController::class, 'edit'])->name('kuliner.edit');
    Route::post('admin/kuliner', [KulinerController::class, 'store'])->name('kuliner.store');
    Route::post('/admin/kuliner/update/{id}', [KulinerController::class, 'update'])->name('kuliner.update');
    Route::delete('kuliner/{id}', [KulinerController::class, 'destroy'])->name('kuliner.destroy');


    //Berita Terkini
    Route::get('/admin/berita/index', [BeritaTerkiniController::class, 'index'])->name('berita.index');
    Route::get('/admin/berita/data', [BeritaTerkiniController::class, 'getBeritaData'])->name('berita.getData');
    Route::get('/admin/berita/create', [BeritaTerkiniController::class, 'create'])->name('berita.create');
    Route::get('/admin/berita/{id}/edit', [BeritaTerkiniController::class, 'edit'])->name('berita.edit');
    Route::post('/admin/berita', [BeritaTerkiniController::class, 'store'])->name('berita.store');
    Route::post('/admin/berita/update/{id}', [BeritaTerkiniController::class, 'update'])->name('berita.update');
    Route::delete('berita/{id}', [BeritaTerkiniController::class, 'destroy'])->name('berita.destroy');

    // Event
    Route::get('/admin/event/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/admin/event/data', [EventController::class, 'getEventData'])->name('event.getData');
    Route::get('/admin/event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('/admin/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('admin/event', [EventController::class, 'store'])->name('event.store');
    Route::post('/admin/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});
