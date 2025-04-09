<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

// implementasi POS jobsheet 5
class PenjualanController extends Controller
{
    // Menampilkan halaman awal penjualan
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan yang tercatat dalam sistem'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Ambil data penjualan dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal');

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah penjualan
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Penjualan Baru'
        ];

        $activeMenu = 'penjualan';
        $user = UserModel::all();

        return view('penjualan.create', compact('breadcrumb', 'page', 'activeMenu', 'user'));
    }

    // Menyimpan data penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date'
        ]);

        PenjualanModel::create($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    // Menampilkan detail penjualan
    public function show(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Data Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', compact('breadcrumb', 'page', 'activeMenu', 'penjualan'));
    }

    // Menampilkan halaman form edit penjualan
    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Penjualan'
        ];

        $activeMenu = 'penjualan';
        $user = UserModel::all();

        return view('penjualan.edit', compact('breadcrumb', 'page', 'activeMenu', 'penjualan', 'user'));
    }

    // Menyimpan perubahan data penjualan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date'
        ]);

        PenjualanModel::find($id)->update($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diperbarui');
    }

    // Menghapus data penjualan
    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}


// implementasi POS jobsheet 4
// class PenjualanController extends Controller
// {
//     public function index()
//     {
//         $penjualan = PenjualanModel::all(); // Ambil semua data dari tabel t_penjualan
//         return view('penjualan', ['data' => $penjualan]);
//     }

//     public function tambah()
//     {
//         return view('penjualan_tambah');
//     }

//     public function tambah_simpan(Request $request)
//     {
//         PenjualanModel::create([
//             'user_id' => $request->user_id,
//             'pembeli' => $request->pembeli,
//             'penjualan_kode' => $request->penjualan_kode,
//             'penjualan_tanggal' => $request->penjualan_tanggal,
//         ]);

//         return redirect('/penjualan');
//     }

//     public function ubah($id)
//     {
//         $penjualan = PenjualanModel::find($id);
//         return view('penjualan_ubah', ['data' => $penjualan]);
//     }

//     public function ubah_simpan($id, Request $request)
//     {
//         $penjualan = PenjualanModel::find($id);

//         $penjualan->user_id = $request->user_id;
//         $penjualan->pembeli = $request->pembeli;
//         $penjualan->penjualan_kode = $request->penjualan_kode;
//         $penjualan->penjualan_tanggal = $request->penjualan_tanggal;

//         $penjualan->save();

//         return redirect('/penjualan');
//     }

//     public function hapus($id)
//     {
//         $penjualan = PenjualanModel::find($id);
//         $penjualan->delete();

//         return redirect('/penjualan');
//     }
// }

