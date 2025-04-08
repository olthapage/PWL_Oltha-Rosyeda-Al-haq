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
            ['barang_id' => '1','barang_kode' => 'BRG1', 'barang_nama' => 'Sapu', 'kategori_id' => 1, 'harga_beli' => 12000, 'harga_jual' => 15000],
            ['barang_id' => '2','barang_kode' => 'BRG2', 'barang_nama' => 'Vacuum Cleaner', 'kategori_id' => 2, 'harga_beli' => 350000, 'harga_jual' => 500000],
            ['barang_id' => '3','barang_kode' => 'BRG3', 'barang_nama' => 'Nugget', 'kategori_id' => 3, 'harga_beli' => 25000, 'harga_jual' => 40000],
            ['barang_id' => '4','barang_kode' => 'BRG4', 'barang_nama' => 'Susu UHT 250ml', 'kategori_id' => 4, 'harga_beli' => 5000, 'harga_jual' => 70000],
            ['barang_id' => '5','barang_kode' => 'BRG5', 'barang_nama' => 'Pulpen', 'kategori_id' => 5, 'harga_beli' => 2000, 'harga_jual' => 5000],
        ];
        DB::table('m_barang')->insert($data);
    }
}
