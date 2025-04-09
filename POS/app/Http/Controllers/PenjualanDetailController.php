<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Yajra\DataTables\Facades\DataTables;

// implementasi POS jobsheet 5
class PenjualanDetailController extends Controller
{
    // Menampilkan halaman awal detail penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar detail penjualan'
        ];

        $activeMenu = 'penjualanDetail';

        return view('penjualanDetail.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function list(Request $request)
    {
        $data = DB::table('t_penjualan_detail')
            ->join('m_barang', 't_penjualan_detail.barang_id', '=', 'm_barang.barang_id')
            ->join('t_penjualan', 't_penjualan_detail.penjualan_id', '=', 't_penjualan.penjualan_id')
            ->select(
                't_penjualan_detail.detail_id',
                't_penjualan_detail.penjualan_id',
                'm_barang.barang_nama',
                't_penjualan_detail.harga',
                't_penjualan_detail.jumlah',
                DB::raw('t_penjualan_detail.harga * t_penjualan_detail.jumlah as total')
            );

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
