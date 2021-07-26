<?php

namespace App\Http\Controllers\Upt;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\Retribusi;
use App\Models\Mpasar\RiwayatKontrak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class KontrakPedagangController extends Controller
{
    public function index()
    {
        return view('upt.kontrakPedagang.index');
    }

    public function dtKontrak_Verifikasi()
    {
        $kontrakPedagang_terVerifikasi = KontrakPedagang::with('pedagang.mPasar')->latest()->get();
        
        return \datatables()->of($kontrakPedagang_terVerifikasi)
        ->addColumn('action', function(KontrakPedagang $kontrak){
            $btn = '
            <a href="/upt/kontrak/detail/' . $kontrak->id . '" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Detail data."><i class="fa fa-eye"></i></a>
            ';
            return $btn;
        })
        ->addColumn('tgl_kontrak', function(KontrakPedagang $kontrakPedagang){
            $tglKontrak = Carbon::parse($kontrakPedagang->tglKontrak)->format('d-M-y') .' - '. Carbon::parse($kontrakPedagang->akhirKontrak)->format('d-M-y');

            return $tglKontrak;
        })
        ->rawColumns(['action', 'tgl_kontrak'])
        ->addIndexColumn()
        ->toJson();
    }

    public function show($id)
    {   
        $verifikasiPedagang = KontrakPedagang::findOrFail($id);
        return \view('admin.kontrakPedagang.show', [
            'verifikasiPedagang' => $verifikasiPedagang,
            'contrakHistories' => RiwayatKontrak::where('kontrakPedagang_id', $verifikasiPedagang->id)->latest()->get(),
            'detailRetribusi' => Retribusi::where('pedagang_id', $verifikasiPedagang->pedagang_id)->get(),
            'ranges' => $this->getRangePaymentRettibution($id),
        ]);
    }

    public function getRangeRetribusiPayment($id)
    {
        $KontrakPedagang = KontrakPedagang::findOrFail($id);

        $retribusi = Retribusi::latest('tglBayar_retribusi')->first();

        $date = $retribusi == '' ? $KontrakPedagang->tglKontrak : $retribusi->tglBayar_retribusi;

        $date = Carbon::parse($date)->addDay();
        $now = Carbon::now()->format('Y-m-d');
        $dateRange = CarbonPeriod::create($date, $now);
        $dates = [];
        foreach($dateRange as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }

    public function getRangePaymentRettibution($id)
    {
        $KontrakPedagang = KontrakPedagang::findOrFail($id);
        $diffDatePayRetribution = $this->getRangeRetribusiPayment($id);
    
        $range = [];
        foreach($diffDatePayRetribution as $date){
            $range[] = [
                'pedagang' => $KontrakPedagang->pedagang_id,
                'date' => Carbon::parse($date)->format('d-M-Y'),
                'tarif' => $KontrakPedagang->pedagang->lapak->tarif
            ];
        }

        return $range;
    }
}
