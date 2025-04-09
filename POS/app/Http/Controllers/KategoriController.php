<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KategoriModel;
use App\DataTables\Kategorkategori_idataTable;
use Yajra\DataTables\Facades\DataTables;


class KategoriController extends Controller
{
    // Menampilkan halaman awal kategori
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang tersedia dalam sistem'
        ];

        $activeMenu = 'kategori'; // set menu yang sedang aktif
        $kategori = KategoriModel::all(); // Ambil semua data kategori

        return view('kategori.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data kategori dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $kategori = KategoriModel::select('kategori_id','kategori_kode', 'kategori_nama');

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/kategori/' . $kategori->kategori_id) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Menampilkan halaman form tambah kategori
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan data kategori baru
    public function store(Request $request)
    {
        $request->valkategori_idate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama'
        ]);

        KategoriModel::create([
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
    }

    // Menampilkan detail kategori
    public function show(string $kategori_id)
    {
        $kategori = KategoriModel::find($kategori_id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data kategori tkategori_idak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menampilkan halaman form edit kategori
    public function edit(string $kategori_id)
    {
        $kategori = KategoriModel::find($kategori_id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data kategori tkategori_idak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit kategori'
        ];

        $activeMenu = 'kategori';

        return view('kategori.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'kategori' => $kategori,
            'activeMenu' => $activeMenu
        ]);
    }

    // Menyimpan perubahan data kategori
    public function update(Request $request, string $kategori_id)
    {
        $request->valkategori_idate([
            'kategori_nama' => 'required|string|min:3|unique:m_kategori,kategori_nama,' . $kategori_id . ',kategori_id'
        ]);

        $kategori = KategoriModel::find($kategori_id);
        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data kategori tkategori_idak ditemukan');
        }

        $kategori->update([
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil diperbarui');
    }

    // Menghapus data kategori
    public function destroy(string $kategori_id)
    {
        $kategori = KategoriModel::find($kategori_id);

        if (!$kategori) {
            return redirect('/kategori')->with('error', 'Data kategori tkategori_idak ditemukan');
        }

        try {
            KategoriModel::destroy($kategori_id);
            return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat data lain yang terkait dengan kategori ini');
        }
    }
}

// {
// // implementasi pos jobsheet 3
//     // public function index() {
//     //     // $data = [
//     //     //     'kategori_kode' => 'SNK',
//     //     //     'kategori_nama' => 'Snack/Makanan Ringan',
//     //     //     'created_at' => now()
//     //     // ];
//     //     // DB::table('m_kategori')->insert($data);
//     //     // return 'Insert data baru berhasil';

//     //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->update(['kategori_nama' => 'Camilan']);
//     //     // return "Update data berhasil. Jumlah data yang di update: " . $row.' baris';

//     //     // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
//     //     // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row.' baris';

//     //     $data = DB::table('m_kategori')->get();
//     //     return view('kategori', ['data' => $data]);
//     // }
// // implementasi jobsheet 4
// public function index()
// {
//     $kategori = KategoriModel::all(); // ambil semua data dari tabel t_kategori
//     return view('kategori', ['data' => $kategori]);
// }

// public function tambah()
// {
//     return view('kategori_tambah');
// }

// public function tambah_simpan(Request $request)
// {
//     KategoriModel::create([
//         'kategori_kode' => $request->kategori_kode,
//         'kategori_nama' => $request->kategori_nama,
//     ]);

//     return redirect('/kategori');
// }

// public function ubah($id)
// {
//     $kategori = KategoriModel::find($id);
//     return view('kategori_ubah', ['data' => $kategori]);
// }

// public function ubah_simpan($id, Request $request)
// {
//     $kategori = KategoriModel::find($id);

//     $kategori->kategori_kode = $request->kategori_kode;
//     $kategori->kategori_nama = $request->kategori_nama;

//     $kategori->save();

//     return redirect('/kategori');
// }

// public function hapus($id)
// {
//     $kategori = KategoriModel::find($id);
//     $kategori->delete();

//     return redirect('/kategori');
// }
