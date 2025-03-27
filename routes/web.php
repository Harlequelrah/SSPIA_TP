<?php

use Illuminate\Support\Facades\Route;

// Route pour le tableau de bord
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route pour afficher la liste des parcelles
Route::get('/parcelles', function () {
    return view('parcelles.index');
})->name('parcelles.index');

// Route pour afficher la liste des interventions
Route::get('/interventions', function () {
    return view('interventions.index');
})->name('interventions.index');
