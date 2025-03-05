<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['stok_id' => 1, 'barang_id' => 11,'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 11],
            ['stok_id' => 2, 'barang_id' => 12, 'user_id' => 1,  'stok_tanggal' => now(),'stok_jumlah' => 10],
            ['stok_id' => 3, 'barang_id' => 13, 'user_id' => 1, 'stok_tanggal' => now(), 'stok_jumlah' => 9],
            ['stok_id' => 4, 'barang_id' => 14,'user_id' => 2, 'stok_tanggal' => now(), 'stok_jumlah' => 10],
            ['stok_id' => 5, 'barang_id' => 15,  'user_id' => 2, 'stok_tanggal' => now(),'stok_jumlah' => 8],
            ['stok_id' => 6, 'barang_id' => 16, 'user_id' => 2, 'stok_tanggal' => now(),'stok_jumlah' => 7],
            ['stok_id' => 7, 'barang_id' => 17, 'user_id' => 3, 'stok_tanggal' => now(),'stok_jumlah' => 5],
            ['stok_id' => 8, 'barang_id' => 18, 'user_id' => 3, 'stok_tanggal' => now(),'stok_jumlah' => 6],
            ['stok_id' => 9, 'barang_id' => 19, 'user_id' => 3, 'stok_tanggal' => now(),'stok_jumlah' => 11],
            ['stok_id' => 10, 'barang_id' => 20, 'user_id' => 3, 'stok_tanggal' => now(),'stok_jumlah' => 7],
        ];
        DB::table('t_stok')->insert($data);
        
    }
}
