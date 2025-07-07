 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reclamos\ReclamoForm;
use App\Livewire\Reclamos\AdminReclamos;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Panel de usuario común
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Crear reclamo (solo usuarios logueados)
Route::get('/reclamos/crear', ReclamoForm::class)
    ->middleware(['auth'])
    ->name('reclamos.crear');

// Panel de administración (solo admins autorizados por Gate)
Route::get('/reclamos/admin', AdminReclamos::class)
    ->middleware(['auth', 'can:ver-admin'])
    ->name('reclamos.admin');

// Rutas para gestionar perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Breeze (login, registro, etc.)
require __DIR__.'/auth.php';

//Perfil de los desarrolladores
Route::get('/desarrolladores', function () {
    return view('desarrolladores');
})->middleware(['auth'])->name('desarrolladores');

