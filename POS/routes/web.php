<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController; 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

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

// Halaman Home
Route::get('/home', [HomeController::class,'home'])->name('home');
// halaman utama products
Route::get('/products', function () {
    return view('products.index');
})->name('products.index');
// Halaman category 
Route::prefix('category')->group(function () {
    Route::get('/food-beverage', [ProductController::class, 'foodBeverage'])->name('category.food');
    Route::get('/beauty-health', [ProductController::class, 'beautyHealth'])->name('category.beauty');
    Route::get('/home-care', [ProductController::class, 'homeCare'])->name('category.home');
    Route::get('/baby-kid', [ProductController::class, 'babyKid'])->name('category.baby');
});
// halaman user
Route::get('/user/{id}/name/{name}', [UserController::class, 'show']); 
// halaman sales
Route::get('/sales', [SalesController::class, 'sales']); 

// implementasi POS jobsheet 3 
Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);




