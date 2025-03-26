<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 11, 'harga' => 12000000, 'jumlah' => 2],
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 13, 'harga' => 400000, 'jumlah' => 1],
            ['detail_id' => 3, 'penjualan_id' => 1, 'barang_id' => 15, 'harga' => 2500000, 'jumlah' => 3],
            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 12, 'harga' => 6000000, 'jumlah' => 2],
            ['detail_id' => 5, 'penjualan_id' => 2, 'barang_id' => 14, 'harga' => 250000, 'jumlah' => 1],
            ['detail_id' => 6, 'penjualan_id' => 2, 'barang_id' => 16, 'harga' => 3500000, 'jumlah' => 3],
            ['detail_id' => 7, 'penjualan_id' => 3, 'barang_id' => 13, 'harga' => 400000, 'jumlah' => 2],
            ['detail_id' => 8, 'penjualan_id' => 3, 'barang_id' => 15, 'harga' => 2500000, 'jumlah' => 1],
            ['detail_id' => 9, 'penjualan_id' => 3, 'barang_id' => 17, 'harga' => 150000, 'jumlah' => 3],
            ['detail_id' => 10, 'penjualan_id' => 4, 'barang_id' => 11, 'harga' => 12000000, 'jumlah' => 2],
            ['detail_id' => 11, 'penjualan_id' => 4, 'barang_id' => 16, 'harga' => 3500000, 'jumlah' => 1],
            ['detail_id' => 12, 'penjualan_id' => 4, 'barang_id' => 18, 'harga' => 700000, 'jumlah' => 3],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
