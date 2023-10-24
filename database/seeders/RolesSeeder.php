<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create([
            'level' => 'Admin',
        ]);

        Roles::create([
            'level' => 'Mahasiswa',
        ]);

        Roles::create([
            'level' => 'Pegawai Bank',
        ]);
    }
}