<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin-test', function () {
    return "Welcome to the admin";
})->middleware('role:Administrateur');;


Route::get('/admin', [TestController::class, 'index']);


