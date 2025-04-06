<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_kode' => 'BRG001', 'barang_nama' => 'Laptop', 'kategori_id' => 1, 'harga_beli' => 10000000, 'harga_jual' => 12000000],
            ['barang_kode' => 'BRG002', 'barang_nama' => 'Smartphone', 'kategori_id' => 1, 'harga_beli' => 5000000, 'harga_jual' => 6000000],
            ['barang_kode' => 'BRG003', 'barang_nama' => 'Keyboard', 'kategori_id' => 2, 'harga_beli' => 300000, 'harga_jual' => 400000],
            ['barang_kode' => 'BRG004', 'barang_nama' => 'Mouse', 'kategori_id' => 2, 'harga_beli' => 200000, 'harga_jual' => 250000],
            ['barang_kode' => 'BRG005', 'barang_nama' => 'Printer', 'kategori_id' => 3, 'harga_beli' => 2000000, 'harga_jual' => 2500000],
            ['barang_kode' => 'BRG006', 'barang_nama' => 'Monitor', 'kategori_id' => 3, 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_kode' => 'BRG007', 'barang_nama' => 'Flashdisk', 'kategori_id' => 4, 'harga_beli' => 100000, 'harga_jual' => 150000],
            ['barang_kode' => 'BRG008', 'barang_nama' => 'Harddisk', 'kategori_id' => 4, 'harga_beli' => 500000, 'harga_jual' => 700000],
            ['barang_kode' => 'BRG009', 'barang_nama' => 'Powerbank', 'kategori_id' => 5, 'harga_beli' => 300000, 'harga_jual' => 350000],
            ['barang_kode' => 'BRG010', 'barang_nama' => 'Speaker', 'kategori_id' => 5, 'harga_beli' => 400000, 'harga_jual' => 500000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
