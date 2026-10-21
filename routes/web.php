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
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::redirect('/front/detail', '/');

Route::get('/detail/{tipe}/{id}', [FrontController::class, 'detailShow'])->name('detail.show');

Route::get('/detail/infokos', [FrontController::class, 'infoKos'])->name('detail.infokos');
Route::get('/detail/kuliner', [FrontController::class, 'kuliner'])->name('detail.kuliner');
Route::get('/detail/event', [FrontController::class, 'event'])->name('detail.event');
Route::get('/detail/info', [FrontController::class, 'info'])->name('detail.info');


Route::get('/login/form', [LoginController::class, 'loginForm'])->name('login');
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
    Route::get('/admin/info/data', [InfoController::class, 'getData'])->name('info.getData');
    Route::get('/admin/info/create', [InfoController::class, 'create'])->name('info.create');
    Route::get('/admin/info/{id}/edit', [InfoController::class, 'edit'])->name('info.edit');
    Route::post('admin/info', [InfoController::class, 'store'])->name('info.store');
    Route::post('/admin/info/update/{id}', [InfoController::class, 'update'])->name('info.update');
    Route::delete('info/{id}', [InfoController::class, 'destroy'])->name('info.destroy');

    // Kuliner
    Route::get('/admin/kuliner/index', [KulinerController::class, 'index'])->name('kuliner.index');
    Route::get('/admin/kuliner/data', [KulinerController::class, 'getData'])->name('kuliner.getData');
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

    // Helper untuk membuat symlink storage via browser jika hosting tidak memiliki akses SSH
    Route::get('/admin/create-storage-link', function () {
        try {
            Artisan::call('storage:link');
            return response()->json([
                'status' => 'success',
                'message' => 'Symlink storage berhasil dibuat: ' . Artisan::output()
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal membuat symlink: ' . $e->getMessage()
            ], 500);
        }
    })->name('admin.storage.link');
});

// Fallback route: memastikan gambar dari storage tetap muncul di hosting meskipun symlink belum/tidak bisa dibuat
Route::get('/storage/{path}', function ($path) {
    // 1. Cek di storage/app/public/
    $storagePath = storage_path('app/public/' . $path);
    if (file_exists($storagePath) && is_file($storagePath)) {
        return response()->file($storagePath);
    }

    // 2. Fallback cek di public/uploads/ (jika file legacy belum dipindah)
    $cleanPath = preg_replace('#^uploads/#', '', $path);
    $publicUploadPath = public_path('uploads/' . $cleanPath);
    if (file_exists($publicUploadPath) && is_file($publicUploadPath)) {
        return response()->file($publicUploadPath);
    }

    // 3. Fallback direct public
    $directPublic = public_path($path);
    if (file_exists($directPublic) && is_file($directPublic)) {
        return response()->file($directPublic);
    }

    abort(404);
})->where('path', '.*');
