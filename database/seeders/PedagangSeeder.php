<?php

namespace Database\Seeders;

use App\Models\MasterData\Lapak;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
            //data dummy pedagang pasar oro oro dowo
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
                'status' => 'verified',
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
                'status' => 'verified',
                'created_at' => Carbon::now()->addMinute(25),
                'updated_at' => Carbon::now(),
            ],

            [
                'lapak_id' => '7',
                'mPasar_id' => 1,
                'nik' => 62758624172,
                'nama' => 'supriyono',
                'tempat_tglLahir' => 'madura 26-09-1978',
                'pekerjaan' => 'pedagang',
                'alamat' => 'Jl klojen Blok Q-23',
                'foto' => '',
                'noTelp' => '08232343232',
                'status' => 'verified',
                'created_at' => Carbon::now()->addMinute(25),
                'updated_at' => Carbon::now(),
            ],
        ];

        $lapak = DB::table('lapaks')->whereIn('id', [14,10,5,7,8])->update(['statusLapak' => 1]);
        Pedagang::insert($pedagang);
        
        $kontrak_pedagang = [
            [
                'pedagang_id' => 3,
                'mPasar_id' => 1,
                'noIzin_pedagang' => '188.445/232/35.73.112/2021',
                'tglKontrak' => Carbon::now()->format('Y-m-d'),
                'akhirKontrak' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'verified'
            ],

            [
                'pedagang_id' => 4,
                'mPasar_id' => 1,
                'noIzin_pedagang' => '119.031/256/34.20.1311/2021',
                'tglKontrak' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'akhirKontrak' => Carbon::now()->addMonths(22)->format('Y-m-d'),
                'status' => 'verified'
            ],

            [
                'pedagang_id' => 5,
                'mPasar' => 1,
                'noIzin_pedagang' => '120.031/258/36.20.1311/2021',
                'tglKontrak' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                'akhirKontrak' => Carbon::now()->addMonths(20)->format('Y-m-d'),
                'status' => 'verified'
            ],
        ];
        KontrakPedagang::insert($kontrak_pedagang);

        //data dummy pedagang yanto
        $start = Carbon::now()->subMonths(4)->format('Y-m-d');
        $finish = Carbon::now()->subMonths(4)->addDays(14)->format('Y-m-d');
        $datesRange = CarbonPeriod::create($start, $finish);

        foreach($datesRange as $date){
            $retribusi = [
                'mPasar_id' => 1,
                'pedagang_id' => 5,
                'lapak_id' => 7,
                'noFaktur' => 'PS/PODO/001',
                'tglBayar_retribusi' => $date->format('Y-m-d'),
                'tarif' => 10000,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            Retribusi::insert($retribusi);
        }

        //data dummy pedagang marni
        $start = Carbon::now()->subMonths(2)->format('Y-m-d');
        $finish = Carbon::now()->addDays(1)->format('Y-m-d');
        $datesRangeMarni = CarbonPeriod::create($start, $finish);

        foreach($datesRangeMarni as $date){
            $retribusiMarni = [
                'mPasar_id' => 1,
                'pedagang_id' => 4,
                'lapak_id' => 8,
                'noFaktur' => 'PS/PODO/002',
                'tglBayar_retribusi' => $date->format('Y-m-d'),
                'tarif' => 10000,
                'status' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            Retribusi::insert($retribusiMarni);
        }
    }
}
