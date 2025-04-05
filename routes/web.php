<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route pour le tableau de bord
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
// Route::get('/', function () {
//     return view('app_layout');
// })->name('dashboard');

// Route pour afficher la liste des parcelles
Route::get('/parcelles', function () {
    return view('parcelles.index');
})->name('parcelles.index');

// Route pour afficher la liste des interventions
Route::get('/interventions', function () {
    return view('interventions.index');
})->name('interventions.index');

Route::get('/users', function () {
    return view('users.index');
})->name('users.index');

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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



