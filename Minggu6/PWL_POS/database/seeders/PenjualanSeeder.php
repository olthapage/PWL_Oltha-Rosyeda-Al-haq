<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Andi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-01 10:00:00')],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Budi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-02 11:30:00')],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Citra', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-03 14:15:00')],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Dian', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-04 16:45:00')],
            ['penjualan_id' => 5, 'user_id' => 2, 'pembeli' => 'Eka', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-05 09:20:00')],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Fahmi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-06 12:10:00')],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Gita', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-07 15:30:00')],
            ['penjualan_id' => 8, 'user_id' => 2, 'pembeli' => 'Hadi', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-08 08:50:00')],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Indra', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-09 13:40:00')],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Joko', 'penjualan_kode' => Str::random(10), 'penjualan_tanggal' => Carbon::parse('2024-03-10 17:05:00')],
        ];
        
        DB::table('t_penjualan')->insert($data);
    }
}