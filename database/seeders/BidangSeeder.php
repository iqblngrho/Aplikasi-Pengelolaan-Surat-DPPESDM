<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = [
            [
                'id' => 1,
                'bidang' => 'Kepala Dinas',
            ],
            [
                'id' => 2,
                'bidang' => 'Sekretaris',
            ],
            [
                'id' => 3,
                'bidang' => 'Tata Usaha',
            ],
            [
                'id' => 4,
                'bidang' => 'Industri',
            ],
            [
                'id' => 5,
                'bidang' => 'Daglu',
            ],
            [
                'id' => 6,
                'bidang' => 'Dagri',
            ],
            [
                'id' => 7,
                'bidang' => 'Listrik/Energi',
            ],
            [
                'id' => 8,
                'bidang' => 'Pengujian/Sertifikasi',
            ],
            [
                'id' => 9,
                'bidang' => 'SDM',
            ],
        ];

        foreach ($bidang as $data) {
            Bidang::create($data);
        }
    }
}
