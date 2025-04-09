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

// implementasi POS jobsheet 4
Route::get('/penjualanDetail', [PenjualanDetailController::class, 'index']);
Route::post('/penjualanDetail/list', [PenjualanDetailController::class, 'list']);

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

// implemetasi POS jobsheet 5

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); // Halaman Level
    Route::post('/list', [LevelController::class, 'list']); // Endpoint DataTables
    Route::get('/{id}', [LevelController::class, 'show']); // Menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']); // Menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']); // Menyimpan perubahan data level
    Route::delete('/{id}', [LevelController::class, 'destroy']); // Menghapus data level
    Route::get('/create', [LevelController::class, 'create']); // Menampilkan formulir tambah level
    Route::post('/', [LevelController::class, 'store']); // Menyimpan data baru
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); // menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']); // menampilkan halaman form tambah katgeori
    Route::post('/', [KategoriController::class, 'store']); // menyimpan data kategori baru
    Route::get('/{id}', [KategoriController::class, 'show']); // menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); // menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']); // menyimpan perubahan data kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']); // menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']); // menampilkan data barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']); // menampilkan halaman form tambahbarang
    Route::post('/', [BarangController::class, 'store']); // menyimpan data barang baru
    Route::get('/{id}', [BarangController::class, 'show']); // menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']); // menampilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']); // menyimpan perubahan data barang
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']); // menampilkan halaman awal supplier
    Route::post('/list', [StokController::class, 'list']); // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create']); // menampilkan halaman form tambahsupplier
    Route::post('/', [StokController::class, 'store']); // menyimpan data supplier baru
    Route::get('/{id}', [StokController::class, 'show']); // menampilkan detail supplier
    Route::get('/{id}/edit', [StokController::class, 'edit']); // menampilkan halaman form edit supplier
    Route::put('/{id}', [StokController::class, 'update']); // menyimpan perubahan data supplier
    Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data supplier
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']); // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']); // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']); // menampilkan halaman form tambahsupplier
    Route::post('/', [SupplierController::class, 'store']); // menyimpan data supplier baru
    Route::get('/{id}', [SupplierController::class, 'show']); // menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']); // menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']); // menyimpan perubahan data supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/', [PenjualanController::class, 'index']); 
    Route::post('/list', [PenjualanController::class, 'list']);
    Route::get('/create', [PenjualanController::class, 'create']);
    Route::post('/', [PenjualanController::class, 'store']); 
    Route::get('/{id}', [PenjualanController::class, 'show']); 
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']); 
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::delete('/{id}', [PenjualanController::class, 'destroy']); 
});

Route::group(['prefix' => 'penjualanDetail'], function () {
    Route::get('/', [PenjualanDetailController::class, 'index']); 
    Route::post('/list', [PenjualanDetailController::class, 'list']);
    Route::get('/create', [PenjualanDetailController::class, 'create']);
    Route::post('/', [PenjualanDetailController::class, 'store']); 
    Route::get('/{id}', [PenjualanDetailController::class, 'show']); 
    Route::get('/{id}/edit', [PenjualanDetailController::class, 'edit']); 
    Route::put('/{id}', [PenjualanDetailController::class, 'update']);
    Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']); 
});


