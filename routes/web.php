<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Rotta per la home
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Rotta per la dashboard (per utenti autenticati)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Rotte per il profilo (solo per utenti autenticati)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rotte protette per admin (autenticati e con ruolo admin)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/camere', [AdminController::class, 'showRooms'])->name('admin.camere');
    Route::get('/admin/prenotazioni', [AdminController::class, 'showBookings'])->name('admin.prenotazioni');
    Route::get('/admin/add-room', [AdminController::class, 'createRoom'])->name('admin.add-room');
    Route::post('/admin/add-room', [AdminController::class, 'storeRoom'])->name('admin.store-room');
    Route::get('/admin/edit-room/{id}', [AdminController::class, 'editRoom'])->name('admin.edit-room');
    Route::post('/admin/edit-room/{id}', [AdminController::class, 'updateRoom'])->name('admin.update-room');
    Route::get('/admin/delete-room/{id}', [AdminController::class, 'deleteRoom'])->name('admin.delete-room');
});

// Rotta per visualizzare le camere nella homepage
Route::get('/', [RoomController::class, 'index']);

// Rotta per prenotazioni
Route::post('/prenotazioni', [BookingController::class, 'store'])->name('prenotazioni.store');



require __DIR__ . '/auth.php';
