<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Rani', 'penjualan_kode' => Str::random(5), 'penjualan_tanggal' => Carbon::parse('2025-01-01 10:00:00')],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Nawra', 'penjualan_kode' => Str::random(5), 'penjualan_tanggal' => Carbon::parse('2025-01-01 11:30:00')],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Gadiza', 'penjualan_kode' => Str::random(5), 'penjualan_tanggal' => Carbon::parse('2025-01-01 14:15:00')],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
