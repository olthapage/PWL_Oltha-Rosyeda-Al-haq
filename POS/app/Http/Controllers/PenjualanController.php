<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\PenjualanDetailModel;
use App\Models\StokModel;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

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

        // $penjualan = PenjualanModel::select('penjualan_tanggal')->distinct()->get();
        $penjualan = DB::table('t_penjualan')
            ->select(DB::raw('DATE(penjualan_tanggal) as tanggal'))
            ->distinct()
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('penjualan.index', compact('breadcrumb', 'page', 'activeMenu', 'penjualan'));
    }

    // Ambil data penjualan dalam bentuk JSON untuk DataTables
    public function list(Request $request)
    {
        $penjualan = PenjualanModel::with('user')
            ->select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal');

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('nama', function ($penjualan) {
                return $penjualan->user->nama ?? '-';
            })
            ->addColumn('aksi', function ($penjualan) {
                // $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' . url('/penjualan/' . $penjualan->penjualan_id) . '">' .
                //     csrf_field() . method_field('DELETE') .
                //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                $btn = '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/penjualan/' . $penjualan->penjualan_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
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
    public function create_ajax()
    {
        $user = UserModel::all();
        $barang = BarangModel::all();
        return view('penjualan.create_ajax', compact('user', 'barang'));
    }

    // Simpan data penjualan via AJAX
    public function store_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:255',
            'penjualan_kode' => 'required|string|max:100',
            'penjualan_tanggal' => 'required|date',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required|integer|distinct',
            'harga' => 'array|min:1',
            'harga.*' => 'required|numeric|min:0',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ];
        

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try {
            $penjualan = PenjualanModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal
            ]);

            for ($i = 0; $i < count($request->barang_id); $i++) {
                $barangId = $request->barang_id[$i];
                $harga = $request->harga[$i];
                $jumlah = $request->jumlah[$i];
                $total = $harga * $jumlah;
        
                PenjualanDetailModel::create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $barangId,
                    'harga' => $harga,
                    'jumlah' => $jumlah,
                    'total' => $total,
                ]);

                $stok = StokModel::where('barang_id', $barangId)->first();

                if (!$stok) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Stok barang tidak ditemukan.',
                        'msgField' => []
                    ]);
                }
    
                if ($stok->stok_jumlah < $jumlah) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Jumlah stok tidak mencukupi.',
                        'msgField' => []
                    ]);
                }
    
                $stok->stok_jumlah  -= $jumlah;
                $stok->save();
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Data penjualan berhasil disimpan.',
                'msgField' => []
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'msgField' => []
            ]);
        }
    }

    return redirect('/');
}


    // Tampilkan form edit penjualan via AJAX
    public function edit_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        return view('penjualan.edit_ajax', compact('penjualan', 'user'));
    }

    // Update data penjualan via AJAX
    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'pembeli' => 'required|string|max:255',
                'penjualan_kode' => 'required|string|max:100',
                'penjualan_tanggal' => 'required|date',
                'user_id' => 'required|integer'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $penjualan = PenjualanModel::find($id);
            if ($penjualan) {
                $penjualan->update($request->all());
                // simpan detail penjuaaln
                $detail_ids = $request->detail_id ?? [];
                $barang_ids = $request->barang_id ?? [];
                $hargas = $request->harga ?? [];
                $jumlahs = $request->jumlah ?? [];
                $totals = $request->total ?? [];

                foreach ($barang_ids as $i => $barang_id) {
                    $dataDetail = [
                        'penjualan_id' => $penjualan->penjualan_id,
                        'barang_id' => $barang_id,
                        'harga' => $hargas[$i] ?? 0,
                        'jumlah' => $jumlahs[$i] ?? 0,
                        'total' => $totals[$i] ?? 0
                    ];
    
                    $detail_id = $detail_ids[$i] ?? null;
    
                    if ($detail_id) {
                        PenjualanDetailModel::where('detail_id', $detail_id)->update($dataDetail);
                    } else {
                        PenjualanDetailModel::create($dataDetail);
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Data penjualan berhasil diperbarui',
                    'msgField' => []
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data penjualan tidak ditemukan',
                    'msgField' => []
                ]);
            }
        }

        return redirect('/');
    }

    // Konfirmasi hapus data penjualan (opsional: untuk modal AJAX)
    public function confirm_ajax(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        return view('penjualan.confirm_ajax', compact('penjualan'));
    }

    // Hapus data penjualan via AJAX
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);
            if ($penjualan) {
                $penjualan->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data penjualan berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data penjualan tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
    public function import()
    {
        return view('penjualan.import');
    }
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = ['file_penjualan' => ['required', 'mimes:xlsx', 'max:1024']];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors()
                ]);
            }

            $file = $request->file('file_penjualan');
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];
            $insert_penjualan_detail = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $tanggal = $value['D'];
                        try {
                            $excelDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tanggal);
                            $tanggalFormatted = $excelDate->format('Y-m-d H:i:s');
                        } catch (\Exception $e) {
                            $tanggalFormatted = date('Y-m-d H:i:s', strtotime($tanggal));
                        }
                        $penjualan = PenjualanModel::create([
                            'user_id' => $value['A'],
                            'pembeli' => $value['B'],
                            'penjualan_kode' => $value['C'],
                            'penjualan_tanggal' => $tanggalFormatted,
                            'created_at'  => now()
                        ]);
                        $barang_id = $value['E'];  
                        $harga = $value['F'];      
                        $jumlah = $value['G']; 

                        $insert_penjualan_detail[] = [
                            'penjualan_id' => $penjualan->penjualan_id,
                            'barang_id' => $barang_id,
                            'harga' => $harga,
                            'jumlah' => $jumlah,
                            'created_at' => now()
                        ];
                    }
                }
                if (count($insert_penjualan_detail) > 0) {
                    PenjualanDetailModel::insert($insert_penjualan_detail);
                }
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }

        return redirect('/');
    }
    public function export_excel()
    {
        // ambil data barang yang akan di export
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')->orderBy('penjualan_id')->with('user')->get();

        // load library excel
        // Kemudian kita load library Spreadsheet dan kita tentukan header data pada baris pertama di excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil yang active

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'User Kasir');
        $sheet->setCellValue('C1', 'Pembeli');
        $sheet->setCellValue('D1', 'Kode');
        $sheet->setCellValue('E1', 'Tanggal');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // bold header

        // Selanjutnya, kita looping data yang telah kita dapatkan dari database, kemudian kita masukkan ke dalam cell excel
        $no = 1;
        $baris = 2;
        foreach ($penjualan as $key => $value) {
            $sheet->setCellValue('A' . $baris, $value->penjualan_id);
            $sheet->setCellValue('B' . $baris, $value->user_id);
            $sheet->setCellValue('C' . $baris, $value->pembeli);
            $sheet->setCellValue('D' . $baris, $value->penjualan_kode);
            $sheet->setCellValue('E' . $baris, $value->penjualan_tanggal);
            $baris++;
            $no++;
        }

        // Kita set lebar tiap kolom di excel untuk menyesuaikan dengan panjang karakter pada masing-masing kolom
        foreach (range('A', 'E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size kolom
        }

        // Bagian akhir proses export excel adalah kita set nama sheet, dan proses untuk dapat di download oleh pengguna
        $sheet->setTitle('Data Penjualan'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Penjualan ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    } // end function export_excel
    public function export_pdf()
    {
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')->orderBy('penjualan_id')->with('user')->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Penjualan ' . date('Y-m-d H:i:s') . '.pdf');
    }
    public function show_ajax($id)
    {
        $penjualan = PenjualanModel::find($id);

        return view('penjualan.show_ajax', compact('penjualan'));
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
