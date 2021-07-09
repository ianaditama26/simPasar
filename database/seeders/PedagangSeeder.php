<?php

namespace Database\Seeders;

use App\Models\MasterData\Lapak;
use App\Models\Mpasar\Pedagang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pedagang = [
            [
                'lapak_id' => '14',
                'mPasar_id' => 2,
                'nik' => 1234567890,
                'nama' => 'septian aditama',
                'tempat_tglLahir' => 'bojonegoro 26-09-1998',
                'pekerjaan' => 'mahasiswa',
                'alamat' => 'Perum Puri Kartika Asri Blok Q-23',
                'foto' => 'pedagang/foto/M7jluA0w6e3vl6OchGnGr3kBxLZVOjrmh9vBFuei.jpg',
                'noTelp' => 12345678,
                'status' => 'request',
                'created_at' => Carbon::now()->addMinute(20),
                'updated_at' => Carbon::now(),
            ],

            [
                'lapak_id' => '10',
                'mPasar_id' => 2,
                'nik' => 811319001822,
                'nama' => 'sutiyem',
                'tempat_tglLahir' => 'malang 26-09-1968',
                'pekerjaan' => 'pedagang',
                'alamat' => 'Perum Puri Kartika Asri Blok Q-23',
                'foto' => 'pedagang/foto/GinrL5srARcsqb4UbuPNFQPQfmo37eN3geuMpSda.jpg',
                'noTelp' => 98236876872,
                'status' => 'request',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'lapak_id' => '5',
                'mPasar_id' => 1,
                'nik' => 82983798723443,
                'nama' => 'surati',
                'tempat_tglLahir' => 'malang 26-09-1968',
                'pekerjaan' => 'pedagang',
                'alamat' => 'Perum Puri Cempaka Blok Q-23',
                'foto' => '',
                'noTelp' => '0812132232',
                'status' => 'request',
                'created_at' => Carbon::now()->addMinute(20),
                'updated_at' => Carbon::now(),
            ],

            [
                'lapak_id' => '8',
                'mPasar_id' => 1,
                'nik' => 87428362493682,
                'nama' => 'marni',
                'tempat_tglLahir' => 'madura 26-09-1968',
                'pekerjaan' => 'pedagang',
                'alamat' => 'Perum Puri Cempaka Blok Q-23',
                'foto' => '',
                'noTelp' => '0817122232',
                'status' => 'request',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        $lapak = DB::table('lapaks')->whereIn('id', [14,10,5,8])->update(['statusLapak' => 1]);
        

        Pedagang::insert($pedagang);
    }
}
