<?php

use App\Http\Controllers\KosController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Models\Event;
use App\Models\Kos;
use App\Models\Info;
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
    
    // Info
    Route::get('/admin/info/index', [InfoController::class, 'index'])->name('info.index');
    Route::get('/admin/info/data', [InfoController::class, 'getInfoData'])->name('info.getData');
    Route::get('/admin/info/create', [InfoController::class, 'create'])->name('info.create');
    Route::get('/admin/info/{id}/edit', [InfoController::class, 'edit'])->name('info.edit');
    Route::post('admin/info', [InfoController::class, 'store'])->name('info.store');
    Route::post('/admin/info/update/{id}', [InfoController::class, 'update'])->name('info.update');
    Route::delete('info/{id}', [InfoController::class, 'destroy'])->name('info.destroy');

    // Kuliner
    Route::get('/admin/kuliner/index', [KulinerController::class, 'index'])->name('kuliner.index');
    Route::get('/admin/kuliner/data', [KulinerController::class, 'getKulinerData'])->name('kuliner.getData');
    Route::get('/admin/kuliner/create', [KulinerController::class, 'create'])->name('kuliner.create');
    Route::get('/admin/kuliner/{id}/edit', [KulinerController::class, 'edit'])->name('kuliner.edit');
    Route::post('admin/kuliner', [KulinerController::class, 'store'])->name('kuliner.store');
    Route::post('/admin/kuliner/update/{id}', [KulinerController::class, 'update'])->name('kuliner.update');
    Route::delete('kuliner/{id}', [KulinerController::class, 'destroy'])->name('kuliner.destroy');

    //Kos
    Route::get('/admin/kos/index', [KosController::class, 'index'])->name('kos.index');
    Route::get('/admin/kos/data', [KosController::class, 'getKosData'])->name('kos.getData');
    Route::get('/admin/kos/create', [KosController::class, 'create'])->name('kos.create');
    Route::get('/admin/kos/{id}/edit', [KosController::class, 'edit'])->name('kos.edit');
    Route::post('/admin/kos', [KosController::class, 'store'])->name('kos.store');
    Route::post('/admin/kos/update/{id}', [KosController::class, 'update'])->name('kos.update');
    Route::delete('kos/{id}', [KosController::class, 'destroy'])->name('kos.destroy');

    // Event
    Route::get('/admin/event/index', [EventController::class, 'index'])->name('event.index');
    Route::get('/admin/event/data', [EventController::class, 'getEventData'])->name('event.getData');
    Route::get('/admin/event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('/admin/event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('/event', [EventController::class, 'store'])->name('event.store');
    Route::post('/admin/event/update/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});
