<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PhotoController;




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


Route::get('/hello', function () {
    return 'Hello World';
});



Route::get('/world', function () {
    return 'World';
});

Route::get('/', function () {
    return 'Selamat Datang';
});

Route::get('/about', function () {
    return ' Oltha Rosyeda Al haq, 2341720145';
});

// Route Parameters
// Terkadang saat membuat sebuah URL, kita perlu mengambil sebuah parameter yang merupakan bagian dari segmen URL dalam route kita
Route::get('/user/{oltha}', function ($oltha) {
    return 'Nama saya'. $oltha;
});

Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
    return 'Pos ke-'.$postId." Komentar ke-: ".$commentId;
});

Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID'.$id;
});

// Optional Parameters (percobaan pertama $name=null, lalu percobaan kedua diubah menjadi $name='John')
// Kita dapat menentukan nilai parameter route, tetapi menjadikan nilai parameter route tersebut opsional
Route::get('/user/{name?}', function ($name='John')  {
    return 'Nama saya '.$name; 
});


//Percobban controller
Route::get('/hello', [WelcomeController::class,'hello']); // menambhakan controller WlcomeController pada route
Route::get('index', [HomeController::class,'/']);
Route::get('/about', [AboutController::class,'about']);
Route::get('/articles/{id}', [ArticleController::class,'articles']);

Route::resource('photos', PhotoController::class)->only([
    'index', 'show'
]);
   Route::resource('photos', PhotoController::class)->except([
    'create', 'store', 'update', 'destroy'
]);
   
