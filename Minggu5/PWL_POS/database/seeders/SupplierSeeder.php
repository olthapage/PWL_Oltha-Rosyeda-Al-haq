<?php

namespace Database\Seeders;

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
                'supplier_kode' => 'SUP001',
                'supplier_nama' => 'Supplier Alpha',
                'supplier_alamat' => 'Jl. Raya Malang No. 1',
            ],
            [
                'supplier_kode' => 'SUP002',
                'supplier_nama' => 'Supplier Beta',
                'supplier_alamat' => 'Jl. Soekarno Hatta No. 10',
            ],
            [
                'supplier_kode' => 'SUP003',
                'supplier_nama' => 'Supplier Gamma',
                'supplier_alamat' => 'Jl. Raya Surabaya No. 25',
            ],
        ]);
    }
}
