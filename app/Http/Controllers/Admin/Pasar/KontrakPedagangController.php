<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\VerifikasiPedagang;
use Carbon\Carbon;
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
        $kontrakPedagang_terVerifikasi = KontrakPedagang::where([
            ['mPasar_id', \auth()->user()->pasar_id],
            ['status', '=', 'verified']
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
            'verifikasiPedagang' => $verifikasiPedagang
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
        //update status pedagang = request
        $verifikasi->pedagang->update(['status' => 'request']);
        $verifikasi->forceDelete();
        return \response()->json(['sukses' => true]);
    }
}
