<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LevelModel;
use App\Models\UserModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        //DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        //return 'Insert data baru berhasil'; 

        //$row = DB::update('update m_level set level_nama = ? where level_kode =?', ['Customer', 'CUS']);
        //return 'Update data berhasil. Jumlah data yang diupdate: ' . $row.' baris';

        // $row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil. Jumlah data yang diupdate: ' . $row . ' baris'; 

        // $row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . 'z baris'; // delete

        // $data = DB::select('select * from m_level');
        // return view('level', ['data' => $data]); // untuk menampilkan data yang ada di table m_level

        // Mengambil semua data level dari tabel m_level
        $levels = LevelModel::all();

        // Breadcrumb untuk navigasi
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        // Informasi halaman
        $page = (object) [
            'title' => 'Daftar level yang tersedia'
        ];

        $activeMenu = 'level'; // Menentukan menu yang sedang aktif

        // Mengirimkan data ke view
        return view('level.index', [
            'levels' => $levels,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        // Ambil data dari tabel m_level
        $data = LevelModel::select('level_id', 'level_kode', 'level_nama');



        return DataTables::of($data)
            ->addIndexColumn() // Menambahkan nomor urut
            ->addColumn('aksi', function ($row) {
                // Tambahkan tombol Detail, Edit, dan Hapus
                // $btn = '<a href="' . url('level/' . $row->level_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('level/' . $row->level_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form action="' . url('level/' . $row->level_id) . '" method="POST" style="display:inline-block;">
                //         ' . csrf_field() . method_field('DELETE') . '
                //         <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Hapus</button>
                //      </form>';
                $btn = '<button onclick="modalAction(\'' . url('/level/' . $row->level_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $row->level_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/level/' . $row->level_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Beri tahu DataTables bahwa kolom "aksi" adalah HTML
            ->make(true);
    }



    public function create()
    {
        // Breadcrumb untuk navigasi
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        // Informasi halaman
        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        $activeMenu = 'level'; // Set menu yang sedang aktif

        // Return view dengan data breadcrumb, page, dan active menu
        return view('level.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:50'
        ]);

        // Simpan data ke database
        LevelModel::create([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        // Redirect dengan pesan sukses
        return redirect('/level')->with('success', 'Level berhasil ditambahkan');
    }

    // Menampilkan detail level
    public function show(string $id)
    {
        // Mengambil data level berdasarkan ID
        $level = LevelModel::find($id);

        // Informasi halaman
        $breadcrumb = (object) ['title' => 'Detail Level', 'list' => ['Home', 'Level', 'Detail']];
        $page = (object) ['title' => 'Detail Level'];
        $activeMenu = 'level'; 

        // Kirim data ke view
        return view('level.show', compact('breadcrumb', 'page', 'level', 'activeMenu'));
    }

    public function edit(string $id)
    {
        // Ambil data level berdasarkan level_id
        $level = LevelModel::where('level_id', $id)->first();

        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan.');
        }

        // Breadcrumb dan informasi halaman
        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];

        $activeMenu = 'level';

        // Kirim data ke view
        return view('level.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }


    public function update(Request $request, string $id)
    {
        // Validasi data input
        $request->validate([
            'level_kode' => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',level_id', // Unik kecuali untuk level yang sedang diedit
            'level_nama' => 'required|string|max:50'
        ]);

        // Update data level di database
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan.');
        }

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);

        // Redirect ke halaman daftar level dengan pesan sukses
        return redirect('/level')->with('success', 'Data level berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $level = LevelModel::where('level_id', $id)->first();
        // Periksa apakah data level dengan ID tertentu ada
        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan.');
        }

        try {
            // Menghapus data level
            $level->delete();

            return redirect('/level')->with('success', 'Data level berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error jika ada relasi dengan tabel lain
            return redirect('/level')->with('error', 'Data level gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini.');
        }
    }
    public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('level.create_ajax', ['level' => $level]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:50'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            LevelModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data level berhasil disimpan'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $level = LevelModel::find($id);

        return view('level.edit_ajax', ['level' => $level]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|max:10|unique:m_level,level_kode,' . $id . ',level_id',
                'level_nama' => 'required|string|max:50'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $level = LevelModel::find($id);
            if ($level) {
                $level->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $level = LevelModel::find($id);

        return view('level.confirm_ajax', ['level' => $level]);
    }

    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                $level->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data level berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data level tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
