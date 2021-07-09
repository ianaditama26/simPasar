<?php

namespace Database\Seeders;

use App\Models\Mpasar\MasterPasar;
use Illuminate\Database\Seeder;

class MasterPasarSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mPasar2 = [
            [
                'pasar_id' => 1,
                'kelas_id' => 3,
                'alamat' => 'Jl. Guntur No.20, Oro-oro Dowo, Kec. Klojen, Kota Malang, Jawa Timur 65112',
                'penanggungJawab' => 'Pak bayan'
            ]
        ];
        MasterPasar::insert($mPasar2);

        $mPasar1 = [
            [
                'pasar_id' => 2,
                'kelas_id' => 3,
                'alamat' => 'Pasar, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139',
                'penanggungJawab' => 'Pak Slamet'
            ]
        ];
        MasterPasar::insert($mPasar1);

    }
}
