<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlotController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/admin-test', function () {
    return "Welcome to the admin";
})->middleware('role:Administrateur');

Route::get('/admin', [TestController::class, 'index']);

Route::prefix('/plot')->controller(PlotController::class)->name('plot.')->group(function () {
    Route::get('/plot', 'index')->name('index');

    Route::get("/{plot}/edit", 'edit')->name('edit');

    Route::plot("/{plot}/edit", 'update');

    Route::plot("/new", 'store');

    Route::get("/new", 'create')->name('create');

Route::get("/{plot}", 'show')
    ->where([
        'plot' => '[0-9]+']
    )->name('show');

});
Route::prefix('/intervention')->controller(InterventionController::class)->name('intervention.')->group(function () {
    Route::get('/intervention', 'index')->name('index');

    Route::get("/{intervention}/edit", 'edit')->name('edit');

    Route::intervention("/{intervention}/edit", 'update');

    Route::intervention("/new", 'store');

    Route::get("/new", 'create')->name('create');

    Route::get("/{intervention}", 'show')
        ->where([
            'intervention' => '[0-9]+']
        )->name('show');

});
