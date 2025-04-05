<?php

use Illuminate\Support\Facades\Route;

// Route pour le tableau de bord
Route::get('/', function () {
    return view('app_layout');
})->name('dashboard');

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

// Route::get('/', function () {
//     return view('app');
// });

// Route::get('/auth/login', function () {
//    return view('auth');
// });

