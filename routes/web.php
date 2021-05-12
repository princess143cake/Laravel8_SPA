<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/modal', function () {
    return view('layouts.modal');
});

// Route::get('/outbound', function () {
//     return view('outbound.outbound');
// });

// Route::get('/inbound', function () {
//     return view('inbound.inbound');
// });

// Route::get('/home', function () {
//     return view('home.home');
// });

// Route::get('/app', function () {
//     return view('layouts.app');
// });

// Route::get('/admin', function () {
//     return view('pages.admin');
// });





Route::get('/header', [App\Http\Controllers\AjaxController::class, 'ajax'])->name('layouts.header');;



Auth::routes();

Route::get('/', [App\Http\Controllers\AjaxController::class, 'ajax']);

Route::get('/home', [App\Http\Controllers\AjaxController::class, 'home'])->name('home');

Route::get('/inbound', [App\Http\Controllers\AjaxController::class, 'inbound'])->name('inbound');

Route::get('/outbound', [App\Http\Controllers\AjaxController::class, 'outbound'])->name('outbound');
