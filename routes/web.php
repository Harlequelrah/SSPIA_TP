<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route pour le tableau de bord
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route pour afficher la liste des parcelles
Route::get('/parcelles', function () {
    return view('parcelles.index');
})->name('parcelles.index');

// Route pour afficher la liste des interventions
Route::get('/interventions', function () {
    return view('interventions.index');
})->name('interventions.index');

Route::get('/', function () {
    return view('app');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::get('/auth/login', function () {
//    return view('auth');
// });

require __DIR__.'/auth.php';



