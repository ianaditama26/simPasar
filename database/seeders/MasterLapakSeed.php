<?php

namespace Database\Seeders;

use App\Models\MasterData\Lapak;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MasterLapakSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lapakPasar1 = [
            [
                'mPasar_id' => 1,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 01,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 1,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 02,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 1,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 03,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 1,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 04,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 1,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 05,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 1,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D01',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 1,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D02',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 1,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D03',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Lapak::insert($lapakPasar1);

        $lapakPasar2 = [
            [
                'mPasar_id' => 2,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 01,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 2,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 02,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 2,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 03,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 2,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 04,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'mPasar_id' => 2,
                'tarif' => 4000,
                'zonasi' => 'emperan',
                'komoditas' => 'sayur',
                'noLapak' => 05,
                'luas' => 3,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 2,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D01',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 2,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D02',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'mPasar_id' => 2,
                'tarif' => 10000,
                'zonasi' => 'bidak',
                'komoditas' => 'daging',
                'noLapak' => 'D03',
                'luas' => 3.5,
                'statusLapak' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Lapak::insert($lapakPasar2);
    }
}
