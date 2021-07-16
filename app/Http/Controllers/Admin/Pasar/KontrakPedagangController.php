<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use App\Models\Mpasar\RiwayatKontrak;
use App\Models\Mpasar\VerifikasiPedagang;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KontrakPedagangController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function index()
    {
        return view('admin.kontrakPedagang.index');
    }

    public function dtKontrak_Verifikasi()
    {
        $kontrakPedagang_terVerifikasi = KontrakPedagang::with('pedagang.mPasar')->where([
            ['mPasar_id', \auth()->user()->pasar_id]
        ])->latest()->get();
        
        return \datatables()->of($kontrakPedagang_terVerifikasi)
        ->addColumn('action', 'template.partials.DT-action')
        ->addColumn('tgl_kontrak', function(KontrakPedagang $kontrakPedagang){
            $tglKontrak = Carbon::parse($kontrakPedagang->tglKontrak)->format('d-M-y') .' - '. Carbon::parse($kontrakPedagang->akhirKontrak)->format('d-M-y');

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
    public function formVerifikasiPedagang($id)
    {
        return view('admin.kontrakPedagang.create', [
            'pedagang' => Pedagang::findOrFail($id),
            'pasar' => $this->getMasterPasar()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'noIzin_pedagang' => 'required|unique:kontrak_pedagangs,noIzin_pedagang',
            'tglKontrak' => 'required|date',
            'akhirKontrak' => 'required|date'
        ]);
        
        //create data verifikasi
        $verifikasi = KontrakPedagang::create($request->except('_token'));

        $id = $request->pedagang_id;
        $pedagang = Pedagang::findOrFail($id);
        //update status pedagang menjadi (verified)
        $pedagang->update(['status' => 'verified']);
        //update status lapak menajadi 1 (ditempati)
        $pedagang->lapak->update(['statusLapak' => 1]);

        return Redirect::route('admin.kontrak.show', $verifikasi->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.kontrakPedagang.edit', [
            'verifikasi' => KontrakPedagang::findOrFail($id)
        ]);
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
        $this->validate($request, [
            'noIzin_pedagang' => 'required',
            'tglKontrak' => 'required|date',
            'akhirKontrak' => 'required|date'
        ]);
        
        $verifikasi = KontrakPedagang::findOrFail($id);
        $verifikasi->update($request->except('_token'));

        return Redirect::route('admin.kontrak.show', $verifikasi->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $verifikasi = KontrakPedagang::find($id);
        if ($verifikasi->status != 'verified') {
            //update status pedagang = request
            $verifikasi->pedagang->update(['status' => 'request']);
            $verifikasi->forceDelete();
            $success = \true;
            $message = 'Data Berhasil di hapus'; 
        } else {
            $success = \false;
            $message = 'Data pedagang tidak dapat dihapus';
        }
        
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }

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

    public function perpanjangan(Request $request)
    {
        $kontrakPedagang = KontrakPedagang::find($request->kontrakPedagang_id);
        
        //create riwayat tglKontrak dan akhir kontrak
        RiwayatKontrak::create([
            'kontrakPedagang_id' => $kontrakPedagang->id,
            'riwayat_tglKontrak' => $kontrakPedagang->tglKontrak,
            'riwayat_akhirKontrak' => $kontrakPedagang->akhirKontrak,
            'keterangan' => 'perpanjang kontrak',
            'status' => 'perpanjang'
        ]);

        //update tgl dan akhir kontrak yang baru
        $kontrakPedagang->update([
            'tglKontrak' => $request->riwayat_tglKontrak,
            'akhirKontrak' => $request->riwayat_akhirKontrak,
        ]);

        return Redirect::route('admin.kontrak.show', $kontrakPedagang->id);
    }

    public function pencabutan(Request $request)
    {
        $kontrakPedagang = KontrakPedagang::find($request->kontrakPedagang_id);
        
        //create riwayat tglKontrak dan akhir kontrak
        RiwayatKontrak::create([
            'kontrakPedagang_id' => $kontrakPedagang->id,
            'riwayat_tglKontrak' => $kontrakPedagang->tglKontrak,
            'riwayat_akhirKontrak' => $kontrakPedagang->akhirKontrak,
            'keterangan' => $request->keterangan,
            'status' => 'pencabutan'
        ]);

        //update status pedagang = nonActive
        $kontrakPedagang->pedagang->update(['status' => 'nonActive']);
        //delete
        $kontrakPedagang->pedagang->delete();

        //update status lapak = 0
        $kontrakPedagang->pedagang->lapak(['statusLapak' => 0]);

        //update status = nonActive
        $kontrakPedagang->update(['status' => 'nonActive']);
        //hapus data dari kontrak pedagang
        $kontrakPedagang->delete();

        return Redirect::route('admin.riwayatPedagang.index');
    }
}
