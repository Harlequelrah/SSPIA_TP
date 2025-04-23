<?php

use App\Http\Controllers\AgriculteurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PlotController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app_layout');
})->middleware(['auth', 'verified']);


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route pour afficher la liste des parcelles
Route::resource('plots', PlotController::class);
Route::patch('/plots/update-status', [PlotController::class, 'updateStatus'])->name('plots.update-status');


Route::resource('interventions', InterventionController::class);

// Lister les interventions d’une parcelle.
Route::get('/plots/{plot}/interventions', [InterventionController::class, 'byPlot'])
    ->name('plot.interventions');

// Route pour afficher la liste des interventions

Route::get('interventions/plot/{plot}', [InterventionController::class, 'index2'])
    ->name('interventions.index2');

Route::resource('agriculteurs', AgriculteurController::class);


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


require __DIR__ . '/auth.php';
