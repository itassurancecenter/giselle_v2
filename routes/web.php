<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Layout;
use App\Http\Controllers\Sirkulir;
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

Route::get('/berandas', function () {
    return view('layout/main');
});

Route::get('/', function () {
    return view('layout/login');
});

Route::controller(Layout::class)->group(function(){
    Route::get('/beranda', 'index');
});

Route::controller(Sirkulir::class)->group(function(){
    Route::get('/create-ticket', 'create_ticket_view');
});
