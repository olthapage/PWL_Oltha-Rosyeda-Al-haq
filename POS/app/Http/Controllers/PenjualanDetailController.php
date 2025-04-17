<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\StokModel;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required',
            'barang_id' => 'required',
            'harga' => 'required|numeric',
            'jumlah' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();
        try {
            $detail = new PenjualanDetailModel();
            $detail->penjualan_id = $request->penjualan_id;
            $detail->barang_id = $request->barang_id;
            $detail->harga = $request->harga;
            $detail->jumlah = $request->jumlah;
            $detail->save();

            // Kurangi stok di t_stok
            $stok = StokModel::where('barang_id', $request->barang_id)
                ->orderBy('stok_tanggal', 'desc')
                ->first();

            if ($stok) {
                $stok->stok_jumlah -= $request->jumlah;

                if ($stok->stok_jumlah < 0) {
                    DB::rollBack();
                    return response()->json([
                        'status' => false,
                        'message' => 'Stok tidak mencukupi!'
                    ]);
                }

                $stok->save();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Penjualan berhasil ditambahkan dan stok dikurangi!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ]);
        }
    }
    public function export_excel()
    {
        // Ambil data penjualan detail yang akan di-export
        $penjualanDetail = PenjualanDetailModel::select('penjualan_id', 'barang_id', 'harga', 'jumlah', 'total')->orderBy('penjualan_id')->get();

        // Load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // Ambil yang aktif

        // Tentukan header data pada baris pertama di excel
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'ID Penjualan');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Jumlah');
        $sheet->setCellValue('F1', 'Total');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // Bold header

        // Looping data penjualan detail
        $no = 1;
        $baris = 2;
        foreach ($penjualanDetail as $key => $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->penjualan_id);
            $sheet->setCellValue('C' . $baris, $value->barang_id);
            $sheet->setCellValue('D' . $baris, $value->harga);
            $sheet->setCellValue('E' . $baris, $value->jumlah);
            $sheet->setCellValue('F' . $baris, $value->total);
            $baris++;
            $no++;
        }

        // Set lebar kolom agar sesuai dengan data
        foreach (range('A', 'F') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // Set auto size kolom
        }

        // Set nama sheet dan proses download
        $sheet->setTitle('Data Penjualan Detail'); // Set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Penjualan Detail ' . date('Y-m-d H:i:s') . '.xlsx';

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
    }
    public function export_pdf()
    {
        // Ambil data penjualan detail
        $penjualanDetail = PenjualanDetailModel::select('penjualan_id', 'barang_id', 'harga', 'jumlah', 'total')->orderBy('penjualan_id')->get();

        // Load view PDF dengan data penjualan detail
        $pdf = Pdf::loadView('penjualanDetail.export_pdf', ['penjualanDetail' => $penjualanDetail]);
        $pdf->setPaper('a4', 'portrait'); // Set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // Set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Penjualan Detail ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
