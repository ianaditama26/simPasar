<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\MasterPasar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

class RetribusiController extends Controller
{
    public function getRangeRetribusiPayment($id)
    {
        $KontrakPedagang = KontrakPedagang::findOrFail($id);

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

    public function getKontrakPedagang()
    {
        $verifikasi = KontrakPedagang::with('pedagang.Mpasar.kelas')->where([
            ['mPasar_id', \auth()->user()->pasar_id]
        ])->get();
        return $verifikasi;
    }

    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function index()
    {
        return view('admin.retribusi.index');
    }

    public function dtVerifikasi()
    {
        return \datatables()->of($this->getKontrakPedagang())
        ->addColumn('action', function(KontrakPedagang $KontrakPedagang){
            $btn = '<a href="/admin/retribusi/' . $KontrakPedagang->pedagang_id . '" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat data."><i class="fa fa-eye"></i></a>
            
            <a href="/admin/form/retribusi/' . $KontrakPedagang->id . '" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit data."><i class="fa fa-edit"></i></a>
            ';
                return $btn;
        })
        ->addColumn('tgl_kontrak', function(KontrakPedagang $KontrakPedagang){
            $tglKontrak = Carbon::parse($KontrakPedagang->tglKontrak)->format('d-M-y') .' - '. Carbon::parse($KontrakPedagang->akhirKontrak)->format('d-M-y');

            return $tglKontrak;
        })
        ->rawColumns(['action', 'tgl_kontrak'])
        ->addIndexColumn()
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function formRetribusi($id)
    {
        $KontrakPedagang = KontrakPedagang::findOrFail($id);

        $lastPay_retribtion = Retribusi::where([
            ['mPasar_id', '=', $this->getMasterPasar()->id],
            ['pedagang_id', '=', $KontrakPedagang->pedagang_id]
        ])->latest('tglBayar_retribusi')->first();

        $tglKontrak = $KontrakPedagang->tglKontrak;


        return \view('admin.retribusi.create', [
            'kontrakPedagang' => $KontrakPedagang,
            'dateFirstPay' => $lastPay_retribtion == '' ? $tglKontrak : Carbon::parse($lastPay_retribtion->tglBayar_retribusi)->format('Y-m-d'),
            'ranges' => $this->getRangePaymentRettibution($id)
        ]);
    }

    public function store(Request $request)
    {
        if ($request->finish < $request->start) {
            return \redirect()->back()->with('message', 'Format tanggal pembayaran tidak benar !');
        }
        $start = Carbon::parse($request->start);
        $finish = Carbon::parse($request->finish)->format('Y-m-d');
        $dateRange = CarbonPeriod::create($start, $finish);
        $create = [];

        if ($request->start) {
            foreach($dateRange as $date) {
                $create = [
                    'mPasar_id' => $request->mPasar_id,
                    'pedagang_id' => $request->pedagang_id,
                    'lapak_id' => $request->lapak_id,
                    'tglBayar_retribusi' => $date->format('Y-m-d'),
                    'tarif' => $request->tarif
                ];
                Retribusi::updateOrCreate([
                    'tglBayar_retribusi' => $date->format('Y-m-d')
                ], $create);
            }
        }

        return \redirect()->route('admin.retribusi.index')->with('message', 'Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedagang = Pedagang::findOrFail($id);

        return view('admin.retribusi.show', [
            'pedagang' => $pedagang,
            'detailRetribusi' => Retribusi::where('pedagang_id', $pedagang->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
