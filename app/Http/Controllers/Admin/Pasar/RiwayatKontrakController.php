<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\RiwayatKontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RiwayatKontrakController extends Controller
{
    public function perpanjangan(Request $request)
    {
        $kontrakPedagang = KontrakPedagang::find($request->kontrakPedagang_id);
        
        //create riwayat tglKontrak dan akhir kontrak
        RiwayatKontrak::create([
            'kontrakPedagang_id' => $kontrakPedagang->id,
            'riwayat_tglKontrak' => $kontrakPedagang->tglKontrak,
            'riwayat_akhirKontrak' => $kontrakPedagang->akhirKontrak,
            'keterangan' => 'perpanjang kontrak'
        ]);

        //update tgl dan akhir kontrak yang baru
        $kontrakPedagang->update([
            'tglKontrak' => $request->riwayat_tglKontrak,
            'akhirKontrak' => $request->riwayat_akhirKontrak,
        ]);

        return Redirect::route('admin.kontrak.show', $kontrakPedagang->id);
    }
}
