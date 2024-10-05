<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotManController;

// Rotta per la home
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Rotta per la home (per utenti autenticati)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Rotte per il profilo (solo per utenti autenticati)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotta per prenotazioni
    Route::post('/prenotazioni', [BookingController::class, 'store'])->name('prenotazioni.store');
    Route::get('/booking/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
    Route::post('/booking/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    Route::post('/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
    Route::get('/user/bookings', [BookingController::class, 'userBookings'])->name('user.bookings');
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

Route::match(['get', 'post'], '/botman/chat', [BotManController::class, 'handle']);

// Rotta per visualizzare tutte le camere
Route::get('/camere', [RoomController::class, 'showAll'])->name('rooms.camere');



require __DIR__ . '/auth.php';
