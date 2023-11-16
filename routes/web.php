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
    Route::get('/', 'loginView')->name('login-view');
    Route::post('/doLogin', 'doLogin')->name('login.doLogin');
    Route::get('/doLogout', 'doLogout')->name('auth.logout');
});

Route::middleware(['auth'])->group(function(){
    Auth::routes();

    Route::controller(Layout::class)->group(function(){
        Route::get('/beranda', 'index')->name('beranda');
    });

    Route::controller(Sirkulir::class)->group(function(){
        Route::get('/buat-tiket', 'createTicketView');
        Route::post('/store-tiket', 'createTicket')->name('create-tiket');
        Route::get('/tambah-dokumen/{id_ticket}', 'addDocumentView')->name('tambah-dokumen');
        Route::get('/list-sirkulir', 'listSirkulir')->name('list.sirkulir');
        Route::get('/list-done-signed', 'listSirkulir')->name('list-done-signed');
        Route::get('/list-done', 'listSirkulir')->name('list-done');
        Route::get('/detail-tiket/{id_ticket}', 'detailTicket')->name('detail-tiket');
        Route::get('/update-status/{document_id}', 'updateStatus')->name('update-status');
        Route::post('/store-dokumen/{id_ticket}', 'addDocument')->name('store-dokumen');
        Route::post('/bulk-update-status', 'bulkUpdateStatus')->name('bulk-update-status');
        Route::post('dokumen/upload-file/{document_id}', 'uploadFile')->name('dokumen.uploadFile');
        Route::post('dokumen/terima-dokumen/{document_id}', 'acceptFile')->name('dokumen.terima');
        Route::post('dokumen/tolak-dokumen/{document_id}', 'rejectFile')->name('dokumen.tolak');
    });

    Route::controller(Master::class)->group(function(){
        Route::get('data-mitra', 'dataMitra')->name('master-dataMitra');
        Route::get('data-user', 'dataUser')->name('master-dataUser');

    });



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

