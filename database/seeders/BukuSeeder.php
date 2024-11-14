<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('buku')->insert([
            [
                'judul' => 'Judul Buku 1',
                'pengarang' => 'Pengarang 1',
                'jenis' => 'Fiksi',
                'jumlah' => 5,
                'tahun_terbit' => '2019',
                'tersedia' => 1,
                'foto' => 'foto_buku_1.jpg',
            ],
            [
                'judul' => 'Judul Buku 2',
                'pengarang' => 'Pengarang 2',
                'jenis' => 'Non-Fiksi',
                'jumlah' => 3,
                'tahun_terbit' => '2018',
                'tersedia' => 1,
                'foto' => 'foto_buku_2.jpg',
            ],
        ]);
    }
}
