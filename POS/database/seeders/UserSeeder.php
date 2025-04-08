<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'user_id' => 1,
                'level_id' => 1,
                'username' => 'admin1',
                'nama' => 'Rania Admin 1',
                'password' => Hash::make('admin1'), 
            ],
            [
                'user_id' => 2,
                'level_id' => 2,
                'username' => 'manager1',
                'nama' => 'Reno Manager 1',
                'password' => Hash::make('manager1'),
            ],
            [
                'user_id' => 3,
                'level_id' => 3,
                'username' => 'staff1',
                'nama' => 'Lia Staff 1',
                'password' => Hash::make('staff1'),
            ],
        ];
        DB::table('m_user')->insert($data);
    }
}
