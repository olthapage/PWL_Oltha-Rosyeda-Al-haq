<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Hash;

class BarangController extends Controller
{
    public function index()
    {
        $barang = BarangModel::all(); // ambil semua data dari tabel t_barang
        return view('barang', ['data' => $barang]);
    }

    public function tambah()
    {
        return view('barang_tambah');
    }

    public function tambah_simpan(Request $request)
    {
        BarangModel::create([
            'kategori_id'  => $request->kategori_id,
            'barang_kode'  => $request->barang_kode,
            'barang_nama'  => $request->barang_nama,
            'harga_beli'   => $request->harga_beli,
            'harga_jual'   => $request->harga_jual
        ]);

        return redirect('/barang');
    }

    public function ubah($id)
    {
        $barang = BarangModel::find($id);
        return view('barang_ubah', ['data' => $barang]);
    }

    public function ubah_simpan($id, Request $request)
    {
        $barang = BarangModel::find($id);

        $barang->kategori_id  = $request->kategori_id;
        $barang->barang_kode  = $request->barang_kode;
        $barang->barang_nama  = $request->barang_nama;
        $barang->harga_beli   = $request->harga_beli;
        $barang->harga_jual   = $request->harga_jual;

        $barang->save();

        return redirect('/barang');
    }

    public function hapus($id)
    {
        $barang = BarangModel::find($id);
        $barang->delete();

        return redirect('/barang');
    }
}
