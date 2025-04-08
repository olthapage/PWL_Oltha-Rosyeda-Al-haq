<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjualanDetailModel;

class PenjualanDetailController extends Controller
{
    public function index()
    {
        $detail = PenjualanDetailModel::all();
        return view('penjualandetail', ['data' => $detail]);
    }

    public function tambah()
    {
        return view('penjualandetail_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        PenjualanDetailModel::create([
            'penjualan_id' => $request->penjualan_id,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
        ]);

        return redirect('/penjualandetail');
    }

    public function ubah($id)
    {
        $detail = PenjualanDetailModel::where('detail_id', $id)->first(); // atau find($id) jika 'detail_id' adalah primary key
        return view('penjualandetail_ubah', ['data' => $detail]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $detail = PenjualanDetailModel::where('detail_id', $id)->first(); // sesuaikan jika bukan PK

        $detail->penjualan_id = $request->penjualan_id;
        $detail->barang_id = $request->barang_id;
        $detail->jumlah = $request->jumlah;
        $detail->harga = $request->harga;

        $detail->save();

        return redirect('/penjualandetail');
    }

    public function hapus($id)
    {
        $detail = PenjualanDetailModel::where('detail_id', $id)->first();
        $detail->delete();

        return redirect('/penjualandetail');
    }
}
