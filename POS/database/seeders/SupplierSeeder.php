<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'supplier_id' => '111',
                'supplier_kode' => 'SPP1',
                'supplier_nama' => 'Supplier Gajayana',
                'supplier_alamat' => 'Jl. Bunga Kertas no. 1',
            ],
            [
                'supplier_id' => '112',
                'supplier_kode' => 'SPP2',
                'supplier_nama' => 'Supplier Ramayana',
                'supplier_alamat' => 'Jl. Bunga Mawar no. 5',
            ],
            [
                'supplier_id' => '113',
                'supplier_kode' => 'SPP3',
                'supplier_nama' => 'Supplier Jaya',
                'supplier_alamat' => 'Jl. Bunga Putih no. 10',
            ],
        ]);
    }
}
