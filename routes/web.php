<?php

use App\Http\Controllers\AgriculteurController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\MustChangePasswordController;
use App\Http\Controllers\PlotController;
use App\Http\Middleware\ForcePasswordChange;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', ForcePasswordChange::class])
    ->name('dashboard');

// Route pour afficher la liste des parcelles
Route::resource('plots', PlotController::class);
Route::patch('/plots/update-status', [PlotController::class, 'updateStatus'])->name('plots.update-status');


Route::resource('interventions', InterventionController::class);

// Lister les interventions d’une parcelle.
Route::get('/plots/{plot}/interventions', [InterventionController::class, 'byPlot'])
    ->name('plots.interventions');

Route::get('/plots/{id}/etiquette', [PlotController::class, 'etiquette'])->name('plot.etiquette');


// Route pour afficher la liste des interventions

Route::resource('agriculteurs', AgriculteurController::class);

Route::get('/password/change', [MustChangePasswordController::class, 'showForm'])->name('password.change.form');
Route::post('/password/change', [MustChangePasswordController::class, 'update'])->name('password.change');


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
