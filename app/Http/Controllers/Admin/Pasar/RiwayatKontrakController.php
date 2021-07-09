<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\RiwayatKontrak;
use Illuminate\Http\Request;

class RiwayatKontrakController extends Controller
{
    public function perpanjangan($idVerifikasi)
    {
        $kontrakPedagang = KontrakPedagang::find($idVerifikasi);
        \dd($kontrakPedagang);

        //create riwayat tglKontrak dan akhir kontrak
        RiwayatKontrak::create();

        //update tgl dan akhir kontrak yang baru
    }
}
