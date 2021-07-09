<?php

namespace App\Http\Controllers\SuperAdmin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Kelas;
use App\Models\MasterData\ZonaLapak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return \view('super_admin.masterKelas.index', [
            'zonasi' => ZonaLapak::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function dtKelas()
    {
        return \datatables()->of(Kelas::orderBy('kelas', 'asc')->get())
            ->addColumn('action', function (Kelas $kelas) {
                $btn = '
                <button type="submit" class="button btn btn-danger" style="display: inline" id="delete" data-id="' . $kelas->id . '">
                <i class="fa fa-trash"></i>
                </button>
            ';

                return $btn;
            })
            ->addColumn('tarif', function(Kelas $kelas){
                
                return view('super_admin.masterKelas.listKelasTarif', [
                    'tarifKelas' => $kelas->kelasTarifs
                ]);
            })
            ->rawColumns(['action', 'tarif'])
            ->addIndexColumn()
            ->toJson();
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
            'kelas.*' => 'required',
            'tarif.*' => 'required'
        ]);
    
        $kelas = Kelas::create($request->only('kelas'));

        if (!empty($request->tarif)) {
            foreach($request->tarif as $tarif => $v){
                $kelasTarif = [
                    'kelas_id' => $kelas->id,
                    'zonasi' => $request->zonasi[$tarif],
                    'tarif' => $request->tarif[$tarif]
                ];
                DB::table('tarifs')->insert([
                    'kelas_id' => $request->kelas
                ], $kelasTarif);
            }
        }

        return \redirect()->route('super_admin.master-kelas.index')->with('message', 'Data Kelas Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return \response()->json(['sukses' => true]);
    }
}
