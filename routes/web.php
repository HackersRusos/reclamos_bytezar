 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reclamos\ReclamoForm;
use App\Livewire\Reclamos\ReclamoFilter;
use App\Livewire\Reclamos\AdminReclamos;


/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

//podriamos hacer el perfil de usuario
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/reclamos/crear', ReclamoForm::class)->name('reclamos.crear');
Route::get('/reclamos/admin', AdminReclamos::class)
    ->middleware('can:ver-admin') // si usás autorización
    ->name('reclamos.admin');

//rutas de seguridad
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
