<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Retribusi;
use App\Models\Mpasar\RiwayatKontrak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RiwayatKontrakController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function index()
    {
        return view('admin.riwayatPedagang.index');
    }

    public function riwayatPedagang()
    {
        $riwayatKontrakPedagang = KontrakPedagang::with('pedagang','mPasar')->where([
            ['mPasar_id', \auth()->user()->pasar_id]
        ])->onlyTrashed()->latest()->get();
        
        return \datatables()->of($riwayatKontrakPedagang)
        ->addColumn('action', function(KontrakPedagang $kontrakPedagang){
            $btn = '
            <a href="/admin/riwayat/pedagang/' . $kontrakPedagang->id . '" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat data."><i class="fa fa-eye"></i></a>
            ';
                return $btn;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }
    public function getRangeRetribusiPayment($id)
    {
        $KontrakPedagang = KontrakPedagang::where('id', $id)->onlyTrashed()->first();

        $retribusi = Retribusi::where([
            ['mPasar_id', '=', $this->getMasterPasar()->id],
            ['pedagang_id', '=', $KontrakPedagang->pedagang_id]
        ])->latest('tglBayar_retribusi')->first();

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
        $KontrakPedagang = KontrakPedagang::where('id', $id)->onlyTrashed()->first();
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

    public function show($id)
    {
        $riwayatPedagang = KontrakPedagang::with('pedagang','mPasar')->where('id', $id)->onlyTrashed()->first();
        return view('admin.riwayatPedagang.show', [
            'riwayatPedagang' => $riwayatPedagang,
            'contrakHistories' => RiwayatKontrak::where('kontrakPedagang_id', $riwayatPedagang->id)->latest()->get(),
            'detailRetribusi' => Retribusi::where('pedagang_id', $riwayatPedagang->pedagang_id)->get(),
            'ranges' => $this->getRangePaymentRettibution($id),
        ]);
    }
}
