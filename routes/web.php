<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// route to show the login form

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::middleware('auth')->group(function () {
    Route::get('/products/create', function (Request $request) {
        return view('products.create');
    });
    
    Route::get('/', function (Request $request) {
        return view('products.index');
    });

    
});