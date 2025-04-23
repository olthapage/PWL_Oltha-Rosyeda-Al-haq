<?php

namespace App\Http\Controllers;

use App\Models\BarangModel; 
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller 
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Selamat Datang',
            'list' => ['Home', 'Welcome']
        ];

        $activeMenu = 'dashboard';

        // Menghitung total data
        $totalUser = UserModel::count();
        $totalPenjualan = PenjualanModel::count();
        $totalHargaPenjualan = PenjualanDetailModel::sum('total'); 
        $totalStock = StokModel::sum('stok_jumlah'); 
        
        // Menampilkan barang yang stoknya kurang dari 5
        $lowStockItems = StokModel::select('barang_id', DB::raw('SUM(stok_jumlah) as total_stok'))
            ->groupBy('barang_id')
            ->havingRaw('total_stok < 5')  
            ->get();

        return view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'totalUser' => $totalUser,
            'totalPenjualan' => $totalPenjualan,
            'totalHargaPenjualan' => $totalHargaPenjualan,
            'lowStockItems' => $lowStockItems, 
            'totalStock' => $totalStock, 
        ]);
    }   
}
