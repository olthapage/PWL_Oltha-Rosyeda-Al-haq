<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

// menghandle atau mengarahkan request ke URL rooy ('/') dan mengembalikan tampilan 'welcome'
Route::get('/', function () {
    return view('welcome');
});

// membuat resource route untuk 'stocks' yang akan membuat semua rute CRUD secara otomatis
Route::resource('stocks', ItemController::class);
