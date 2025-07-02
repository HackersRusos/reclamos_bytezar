 <?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReclamoController;

Route::get('/', function () {
    return view('welcome');
});
//podriamos hacer el perfil de usuario
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//pantalla que llamamos "index para reclamos"
Route::get('/reclamos', [ReclamoController::class, 'index'])->name('reclamos.index');

//vista para crear reclamos
Route::get('/reclamos/create', [ReclamoController::class, 'create'])->name('reclamos.create');


Route::get('/reclamos/store', function(){
    return view('reclamos.store');
})-> name ('reclamos.store');

//rutas de seguridad
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
