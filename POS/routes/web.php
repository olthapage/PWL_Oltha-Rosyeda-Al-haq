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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\RegisterController;
use App\Models\User;

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

// implemetasi POS jobsheet 5, tambahan implementasi jobsheet 6 (implementasi ajax)

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/penjualanDetail', [PenjualanDetailController::class, 'index']);
Route::post('/penjualanDetail/list', [PenjualanDetailController::class, 'list']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']);  // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);  // Menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilkan form delete user ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // hapus data user ajax
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']); 
    Route::post('/list', [LevelController::class, 'list']); 
    Route::get('/create', [LevelController::class, 'create']); 
    Route::post('/', [LevelController::class, 'store']); 
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']);  
    Route::post('/ajax', [LevelController::class, 'store_ajax']); 
    Route::get('/{id}', [LevelController::class, 'show']);
    Route::get('/{id}/edit', [LevelController::class, 'edit']); 
    Route::put('/{id}', [LevelController::class, 'update']);
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); 
    Route::delete('/{id}', [LevelController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); 
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']); 
    Route::post('/list', [KategoriController::class, 'list']); 
    Route::get('/create', [KategoriController::class, 'create']); 
    Route::post('/', [KategoriController::class, 'store']); 
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); 
    Route::post('/ajax', [KategoriController::class, 'store_ajax']);  
    Route::get('/{id}', [KategoriController::class, 'show']); 
    Route::get('/{id}/edit', [KategoriController::class, 'edit']); 
    Route::put('/{id}', [KategoriController::class, 'update']);
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); 
    Route::delete('/{id}', [KategoriController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); 
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']); 
    Route::post('/list', [BarangController::class, 'list']); 
    Route::get('/create', [BarangController::class, 'create']); 
    Route::post('/', [BarangController::class, 'store']); 
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);  
    Route::post('/ajax', [BarangController::class, 'store_ajax']);  
    Route::get('/{id}', [BarangController::class, 'show']); 
    Route::get('/{id}/edit', [BarangController::class, 'edit']); 
    Route::put('/{id}', [BarangController::class, 'update']); 
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::delete('/{id}', [BarangController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); 
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']); 
    Route::post('/list', [StokController::class, 'list']); 
    Route::get('/create', [StokController::class, 'create']); 
    Route::get('/create_ajax', [StokController::class, 'create_ajax']);  
    Route::post('/ajax', [StokController::class, 'store_ajax']); 
    Route::post('/', [StokController::class, 'store']); 
    Route::get('/{id}', [StokController::class, 'show']); 
    Route::get('/{id}/edit', [StokController::class, 'edit']); 
    Route::put('/{id}', [StokController::class, 'update']); 
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
    Route::delete('/{id}', [StokController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); 
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']); 
    Route::post('/list', [SupplierController::class, 'list']); 
    Route::get('/create', [SupplierController::class, 'create']); 
    Route::post('/', [SupplierController::class, 'store']); 
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);  
    Route::post('/ajax', [SupplierController::class, 'store_ajax']);  
    Route::get('/{id}', [SupplierController::class, 'show']); 
    Route::get('/{id}/edit', [SupplierController::class, 'edit']); 
    Route::put('/{id}', [SupplierController::class, 'update']); 
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); 
    Route::delete('/{id}', [SupplierController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); 
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/', [PenjualanController::class, 'index']); 
    Route::post('/list', [PenjualanController::class, 'list']);
    Route::get('/create', [PenjualanController::class, 'create']);
    Route::post('/', [PenjualanController::class, 'store']); 
    Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);  
    Route::post('/ajax', [PenjualanController::class, 'store_ajax']); 
    Route::get('/{id}', [PenjualanController::class, 'show']); 
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']); 
    Route::put('/{id}', [PenjualanController::class, 'update']);
    Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']); 
    Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); 
    Route::delete('/{id}', [PenjualanController::class, 'destroy']); 
    Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); 
    Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); 
});

// implementasi POS jobsheet 7 & jobsheet 8 
Route::pattern('id', '[0-9]+'); // artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');

// Route register 
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function() { // artinya semua route di dalam group ini harus login dulu
    Route::get('/', [WelcomeController::class, 'index']);
    // masukkan semua route yang perlu autentikasi di sini

    Route::get('/penjualanDetail', [PenjualanDetailController::class, 'index']);
    Route::post('/penjualanDetail/list', [PenjualanDetailController::class, 'list']);

    Route::middleware(['authorize:ADM'])->group(function(){
        Route::group(['prefix' => 'level'], function () {
            Route::get('/', [LevelController::class, 'index']); 
            Route::post('/list', [LevelController::class, 'list']); 
            Route::get('/create', [LevelController::class, 'create']); 
            Route::post('/', [LevelController::class, 'store']); 
            Route::get('/create_ajax', [LevelController::class, 'create_ajax']);  
            Route::post('/ajax', [LevelController::class, 'store_ajax']); 
            Route::get('/{id}', [LevelController::class, 'show']);
            Route::get('/{id}/edit', [LevelController::class, 'edit']); 
            Route::put('/{id}', [LevelController::class, 'update']);
            Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); 
            Route::delete('/{id}', [LevelController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); 
            Route::get('/import', [LevelController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [LevelController::class, 'import_ajax']);  // ajax import excel
        });
    });

    // artinya semua route di dalam group ini harus punya role ADM(administrator) dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', [BarangController::class, 'index']); 
            Route::post('/list', [BarangController::class, 'list']); 
            Route::get('/create', [BarangController::class, 'create']); 
            Route::post('/', [BarangController::class, 'store']); 
            Route::get('/create_ajax', [BarangController::class, 'create_ajax']);  
            Route::post('/ajax', [BarangController::class, 'store_ajax']);  
            Route::get('/{id}', [BarangController::class, 'show']); 
            Route::get('/{id}/edit', [BarangController::class, 'edit']); 
            Route::put('/{id}', [BarangController::class, 'update']); 
            Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
            Route::delete('/{id}', [BarangController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); 
            Route::get('/import', [BarangController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [BarangController::class, 'import_ajax']);  // ajax import excel
        });
    });

    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
            Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
            Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
            Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
            Route::get('/create_ajax', [UserController::class, 'create_ajax']);  // Menampilkan halaman form tambah user Ajax
            Route::post('/ajax', [UserController::class, 'store_ajax']);  // Menyimpan data user baru Ajax
            Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
            Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
            Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
            Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
            Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
            Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
            Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // untuk tampilkan form delete user ajax
            Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // hapus data user ajax
            Route::get('/import', [UserController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [UserController::class, 'import_ajax']);  // ajax import excel
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'kategori'], function () {
            Route::get('/', [KategoriController::class, 'index']); 
            Route::post('/list', [KategoriController::class, 'list']); 
            Route::get('/create', [KategoriController::class, 'create']); 
            Route::post('/', [KategoriController::class, 'store']); 
            Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); 
            Route::post('/ajax', [KategoriController::class, 'store_ajax']);  
            Route::get('/{id}', [KategoriController::class, 'show']); 
            Route::get('/{id}/edit', [KategoriController::class, 'edit']); 
            Route::put('/{id}', [KategoriController::class, 'update']);
            Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); 
            Route::delete('/{id}', [KategoriController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); 
            Route::get('/import', [KategoriController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);  // ajax import excel
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'stok'], function () {
            Route::get('/', [StokController::class, 'index']); 
            Route::post('/list', [StokController::class, 'list']); 
            Route::get('/create', [StokController::class, 'create']); 
            Route::get('/create_ajax', [StokController::class, 'create_ajax']);  
            Route::post('/ajax', [StokController::class, 'store_ajax']); 
            Route::post('/', [StokController::class, 'store']); 
            Route::get('/{id}', [StokController::class, 'show']); 
            Route::get('/{id}/edit', [StokController::class, 'edit']); 
            Route::put('/{id}', [StokController::class, 'update']); 
            Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
            Route::delete('/{id}', [StokController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); 
            Route::get('/import', [StokController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [StokController::class, 'import_ajax']);  // ajax import excel
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'supplier'], function () {
            Route::get('/', [SupplierController::class, 'index']); 
            Route::post('/list', [SupplierController::class, 'list']); 
            Route::get('/create', [SupplierController::class, 'create']); 
            Route::post('/', [SupplierController::class, 'store']); 
            Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);  
            Route::post('/ajax', [SupplierController::class, 'store_ajax']);  
            Route::get('/{id}', [SupplierController::class, 'show']); 
            Route::get('/{id}/edit', [SupplierController::class, 'edit']); 
            Route::put('/{id}', [SupplierController::class, 'update']); 
            Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); 
            Route::delete('/{id}', [SupplierController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); 
            Route::get('/import', [SupplierController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);  // ajax import excel
        });
    });

    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::group(['prefix' => 'penjualan'], function () {
            Route::get('/', [PenjualanController::class, 'index']); 
            Route::post('/list', [PenjualanController::class, 'list']);
            Route::get('/create', [PenjualanController::class, 'create']);
            Route::post('/', [PenjualanController::class, 'store']); 
            Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);  
            Route::post('/ajax', [PenjualanController::class, 'store_ajax']); 
            Route::get('/{id}', [PenjualanController::class, 'show']); 
            Route::get('/{id}/edit', [PenjualanController::class, 'edit']); 
            Route::put('/{id}', [PenjualanController::class, 'update']);
            Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']); 
            Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); 
            Route::delete('/{id}', [PenjualanController::class, 'destroy']); 
            Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']); 
            Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); 
            Route::get('/import', [PenjualanController::class, 'import']); // ajax form upload excel
            Route::post('/import_ajax', [PenjualanController::class, 'import_ajax']);  // ajax import excel
        });
    });
});

