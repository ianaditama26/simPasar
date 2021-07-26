<?php

namespace Database\Seeders;

use App\Models\MasterData\Kelas;
use App\Models\MasterData\Komoditas;
use App\Models\MasterData\Pasar;
use App\Models\MasterData\Tarif;
use App\Models\MasterData\ZonaLapak;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zonaLapak = [
            [
                'zonaLapak' => 'los',
            ],
            [
                'zonaLapak' => 'emperan',
            ],
            [
                'zonaLapak' => 'bedak',
            ],
        ];
        ZonaLapak::insert($zonaLapak);

        $komoditas = [
            ['komoditas' => 'sayur'],
            ['komoditas' => 'daging'],
            ['komoditas' => 'pecah belah'],
        ];
        Komoditas::insert($komoditas);

        $pasar = [
            [
                'namaPasar' => 'pasar oro oro dowo'
            ],
            [
                'namaPasar' => 'pasar sawo jajar'
            ],
        ];
        Pasar::insert($pasar);

        $kelas = [
            [
                'kelas' => '1'
            ],
            [
                'kelas' => '2'
            ],
            [
                'kelas' => '3'
            ],
        ];
        Kelas::insert($kelas);

        $tarif = [
            [
                'kelas_id' => 1,
                'zonasi' => 'bidak',
                'tarif' => '15000'
            ],
            [
                'kelas_id' => 1,
                'zonasi' => 'los',
                'tarif' => '10000'
            ],

            [
                'kelas_id' => 2,
                'zonasi' => 'bidak',
                'tarif' => '10000'
            ],

            [
                'kelas_id' => 1,
                'zonasi' => 'los',
                'tarif' => '8000'
            ],

            [
                'kelas_id' => 2,
                'zonasi' => 'emper',
                'tarif' => '4000'
            ],

            [
                'kelas_id' => 3,
                'zonasi' => 'los',
                'tarif' => '6000'
            ],

            [
                'kelas_id' => 3,
                'zonasi' => 'emper',
                'tarif' => '3000'
            ],
        ];

        Tarif::insert($tarif);
    }
}
