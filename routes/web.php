<?php

use App\Http\Controllers\Auth as ControllersAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Layout;
use App\Http\Controllers\Sirkulir;
use App\Http\Controllers\Master;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Credentials;
use Illuminate\Support\Facades\Auth;
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

Route::controller(Credentials::class)->group(function(){
    Route::get('/', 'loginView');
    Route::post('/doLogin', 'doLogin')->name('login.doLogin');
});

Auth::routes();

Route::controller(Layout::class)->group(function(){
    Route::get('/beranda', 'index')->name('beranda');
});

Route::controller(Sirkulir::class)->group(function(){
    Route::get('/buat-tiket', 'createTicketView');
    Route::post('/store-tiket', 'createTicket')->name('create-tiket');
    Route::get('/tambah-dokumen/{id_ticket}', 'addDocumentView');
});

Route::controller(Master::class)->group(function(){
    Route::get('data-mitra', 'dataMitra')->name('master-dataMitra');
    Route::get('data-user', 'dataUser')->name('master-dataUser');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
