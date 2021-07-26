<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranLapakRequest;
use App\Models\MasterData\Komoditas;
use App\Models\MasterData\Lapak;
use App\Models\MasterData\Tarif;
use App\Models\MasterData\ZonaLapak;
use App\Models\Mpasar\MasterPasar;
use Illuminate\Http\Request;

class LapakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }
    public function index()
    {
        return view('admin.lapak.index');
    }

    public function dtLapak()
    {
        return \datatables()->of(Lapak::with('mPasar.kelas')->where('mPasar_id', $this->getMasterPasar()->id)->latest()->get())
        ->addColumn('action', 'template.partials.DT-action')
        ->addColumn('tarif', function(Lapak $lapak){
            return $lapak->getFormatTarif() . ' | '. $lapak->zonasi;
            // return $lapak->mPasar->pasar->namaPasar;
        })  
        ->addColumn('statusLapak', function(Lapak $lapak){
            if ($lapak->statusLapak == 1) {
                $status = '
                    <font color="blue">Ditempati</>
                ';
            } else {
                $status = '
                    <font>Kosong</>
                ';
            }

            return $status;
        })
        ->rawColumns(['action', 'tarif', 'statusLapak'])
        ->addIndexColumn()
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.lapak.create', [
            'pasar' => $this->getMasterPasar(),
            'tarif' => Tarif::where('kelas_id', $this->getMasterPasar()->kelas_id)->get(),
            'komoditas' => Komoditas::get(),
            'zonasi' => ZonaLapak::get() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PendaftaranLapakRequest $request)
    {
        Lapak::create($request->except('_token'));
        return \redirect()->route('admin.lapak.index')->with('message', 'Data lapak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.lapak.show', [
            'lapak' => Lapak::findOrFail($id)
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
        $lapak = Lapak::findOrFail($id);
        return \view('admin.lapak.edit', [
            'lapak' => $lapak,
            'pasar' => $this->getMasterPasar(),
            'tarif' => Tarif::where('kelas_id', $this->getMasterPasar()->kelas_id)->get(),
            'komoditas' => Komoditas::get(),
            'zonasi' => ZonaLapak::get() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PendaftaranLapakRequest $request, $id)
    {
        $lapak = Lapak::findOrFail($id);
        $lapak->update($request->except('_token'));
        return \redirect()->route('admin.lapak.index')->with('message', 'Data Lapak Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lapak = Lapak::findOrFail($id);
        if ($lapak->statusLapak == 1) {
            $success = true;
            $message = 'Lapak sedang di pakai';
        } else {
            $lapak->delete();
            $success = false;
            $message = 'Data telah dihapus';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
