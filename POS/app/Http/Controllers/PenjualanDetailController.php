<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'title' => 'Daftar Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar detail penjualan dalam sistem'
        ];

        $activeMenu = 'penjualandetail';
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        return view('penjualandetail.index', compact('breadcrumb', 'page', 'activeMenu', 'penjualan', 'barang'));
    }

    // Ambil data detail penjualan dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $details = PenjualanDetailModel::select('detail_id', 'penjualan_id', 'barang_id', 'jumlah', 'harga')
            ->with(['penjualan', 'barang']);

        return DataTables::of($details)
            ->addIndexColumn()
            ->addColumn('aksi', function ($detail) {
                $btn = '<a href="' . url('/penjualandetail/' . $detail->detail_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualandetail/' . $detail->detail_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualandetail/' . $detail->detail_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah detail penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah detail penjualan baru'
        ];

        $activeMenu = 'penjualandetail';
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        return view('penjualandetail.create', compact('breadcrumb', 'page', 'penjualan', 'barang', 'activeMenu'));
    }

    // Menyimpan data detail penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        PenjualanDetailModel::create($request->all());

        return redirect('/penjualandetail')->with('success', 'Detail penjualan berhasil disimpan');
    }

    // Menampilkan detail satu data
    public function show(string $id)
    {
        $detail = PenjualanDetailModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Data Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data penjualan'
        ];

        $activeMenu = 'penjualandetail';

        return view('penjualandetail.show', compact('breadcrumb', 'page', 'detail', 'activeMenu'));
    }

    // Menampilkan halaman form edit detail penjualan
    public function edit(string $id)
    {
        $detail = PenjualanDetailModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Detail Penjualan',
            'list' => ['Home', 'Detail Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit detail penjualan'
        ];

        $activeMenu = 'penjualandetail';
        $penjualan = PenjualanModel::all();
        $barang = BarangModel::all();

        return view('penjualandetail.edit', compact('breadcrumb', 'page', 'detail', 'penjualan', 'barang', 'activeMenu'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, string $id)
    {
        $request->validate([
            'penjualan_id' => 'required|integer',
            'barang_id' => 'required|integer',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        PenjualanDetailModel::find($id)->update($request->all());

        return redirect('/penjualandetail')->with('success', 'Detail penjualan berhasil diperbarui');
    }

    // Menghapus data
    public function destroy(string $id)
    {
        $check = PenjualanDetailModel::find($id);
        if (!$check) {
            return redirect('/penjualandetail')->with('error', 'Data tidak ditemukan');
        }

        try {
            PenjualanDetailModel::destroy($id);
            return redirect('/penjualandetail')->with('success', 'Data berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualandetail')->with('error', 'Gagal menghapus data karena terkait dengan tabel lain');
        }
    }
}

// implementasi POS jobsheet 4
// class PenjualanDetailController extends Controller
// {
//     public function index()
//     {
//         $detail = PenjualanDetailModel::all();
//         return view('penjualandetail', ['data' => $detail]);
//     }

//     public function tambah()
//     {
//         return view('penjualandetail_tambah');
//     }

//     public function tambah_simpan(Request $request)
//     {
//         PenjualanDetailModel::create([
//             'penjualan_id' => $request->penjualan_id,
//             'barang_id' => $request->barang_id,
//             'jumlah' => $request->jumlah,
//             'harga' => $request->harga,
//         ]);

//         return redirect('/penjualandetail');
//     }

//     public function ubah($id)
//     {
//         $detail = PenjualanDetailModel::where('detail_id', $id)->first(); // atau find($id) jika 'detail_id' adalah primary key
//         return view('penjualandetail_ubah', ['data' => $detail]);
//     }

//     public function ubah_simpan($id, Request $request)
//     {
//         $detail = PenjualanDetailModel::where('detail_id', $id)->first(); // sesuaikan jika bukan PK

//         $detail->penjualan_id = $request->penjualan_id;
//         $detail->barang_id = $request->barang_id;
//         $detail->jumlah = $request->jumlah;
//         $detail->harga = $request->harga;

//         $detail->save();

//         return redirect('/penjualandetail');
//     }

//     public function hapus($id)
//     {
//         $detail = PenjualanDetailModel::where('detail_id', $id)->first();
//         $detail->delete();

//         return redirect('/penjualandetail');
//     }
// }
