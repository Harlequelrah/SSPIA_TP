<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PlotController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('app_layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.index');

// Route pour afficher la liste des parcelles
Route::resource('parcelles', PlotController::class);


Route::resource('interventions', InterventionController::class);
// Route pour afficher la liste des interventions

Route::get('/users', function () {
    return view('users.index');
})->name('users.index');


Route::get('/parametre', function () {
    return view('settings.index');
})->name('settings.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin-only', function () {
    return 'Bienvenue Admin !';
})->middleware(['auth', 'role:Administrateur']);

// Route::post('/logout', function () {
//     auth()->guard()->logout();     // Déconnexion
//     return redirect('/'); // Redirection après déconnexion
// })->name('logout');


require __DIR__.'/auth.php';



