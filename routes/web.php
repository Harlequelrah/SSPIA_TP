<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('app_layout');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard.index');

// Route pour afficher la liste des parcelles
Route::get('/parcelles', function () {
    return view('parcelles.index');
})->name('parcelles.index');

// Route pour afficher la liste des interventions
Route::get('/interventions', function () {
    return view('interventions.index');
})->name('interventions.index');

Route::get('/interventions/{id}', function ($id) {
    $intervention = (object)[
        'id' => $id,
        'parcelle' => 'Parcelle Nord',
        'type' => 'Semis',
        'date' => '2024-03-15',
        'description' => 'Irrigation après semis',
        'quantite' => '25 kg/ha',
    ];

    return view('interventions.show', compact('intervention'));
})->name('interventions.show');

Route::get('/interventions/detail', function () {
    return view('interventions.show');
})->name('interventions.show');

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



