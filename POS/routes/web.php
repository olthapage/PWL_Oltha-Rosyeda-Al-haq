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
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;

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
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/penjualan', [PenjualanController::class, 'index']);
Route::get('/stok', [StokController::class, 'index']);
Route::get('/penjualandetail', [PenjualanDetailController::class, 'index']);

// implementasi POS jobsheet 4
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/barang/tambah', [BarangController::class, 'tambah']);
Route::post('/barang/tambah_simpan', [BarangController::class, 'tambah_simpan']);
Route::get('/barang/ubah/{id}', [BarangController::class, 'ubah']);
Route::put('/barang/ubah_simpan/{id}', [BarangController::class, 'ubah_simpan']);
Route::get('/barang/hapus/{id}', [BarangController::class, 'hapus']);

Route::get('/kategori/tambah', [KategoriController::class, 'tambah']);
Route::post('/kategori/tambah_simpan', [KategoriController::class, 'tambah_simpan']);
Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah']);
Route::put('/kategori/ubah_simpan/{id}', [KategoriController::class, 'ubah_simpan']);
Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus']);

Route::get('/level/tambah', [LevelController::class, 'tambah']);
Route::post('/level/tambah_simpan', [LevelController::class, 'tambah_simpan']);
Route::get('/level/ubah/{id}', [LevelController::class, 'ubah']);
Route::put('/level/ubah_simpan/{id}', [LevelController::class, 'ubah_simpan']);
Route::get('/level/hapus/{id}', [LevelController::class, 'hapus']);

Route::get('/penjualan/tambah', [PenjualanController::class, 'tambah']);
Route::post('/penjualan/tambah_simpan', [PenjualanController::class, 'tambah_simpan']);
Route::get('/penjualan/ubah/{id}', [PenjualanController::class, 'ubah']);
Route::put('/penjualan/ubah_simpan/{id}', [PenjualanController::class, 'ubah_simpan']);
Route::get('/penjualan/hapus/{id}', [PenjualanController::class, 'hapus']);

Route::get('/penjualanDetail/tambah', [PenjualanDetailController::class, 'tambah']);
Route::post('/penjualanDetail/tambah_simpan', [PenjualanDetailController::class, 'tambah_simpan']);
Route::get('/penjualanDetail/ubah/{id}', [PenjualanDetailController::class, 'ubah']);
Route::put('/penjualanDetail/ubah_simpan/{id}', [PenjualanDetailController::class, 'ubah_simpan']);
Route::get('/penjualanDetail/hapus/{id}', [PenjualanDetailController::class, 'hapus']);

Route::get('/stok/tambah', [StokController::class, 'tambah']);
Route::post('/stok/tambah_simpan', [StokController::class, 'tambah_simpan']);
Route::get('/stok/ubah/{id}', [StokController::class, 'ubah']);
Route::put('/stok/ubah_simpan/{id}', [StokController::class, 'ubah_simpan']);
Route::get('/stok/hapus/{id}', [StokController::class, 'hapus']);

Route::get('/supplier/tambah', [SupplierController::class, 'tambah']);
Route::post('/supplier/tambah_simpan', [SupplierController::class, 'tambah_simpan']);
Route::get('/supplier/ubah/{id}', [SupplierController::class, 'ubah']);
Route::put('/supplier/ubah_simpan/{id}', [SupplierController::class, 'ubah_simpan']);
Route::get('/supplier/hapus/{id}', [SupplierController::class, 'hapus']);




