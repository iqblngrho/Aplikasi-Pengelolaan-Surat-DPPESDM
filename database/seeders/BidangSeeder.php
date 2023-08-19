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
                'bidang' => 'Industri',
            ],
            [
                'id' => 4,
                'bidang' => 'Tata Usaha',
            ],
            [
                'id' => 5,
                'bidang' => 'Ekspor',
            ],
            [
                'id' => 6,
                'bidang' => 'Impor',
            ],
        ];

        foreach ($bidang as $data) {
            Bidang::create($data);
        }
    }
}
