<?php

namespace App\Http\Controllers\SuperAdmin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\ZonaLapak;
use Illuminate\Http\Request;

class ZonaLapakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('super_admin.masterZonasi.index');
    }

    public function dtZonaLapak()
    {
        return \datatables()->of(ZonaLapak::latest()->get())
            ->addColumn('action', function (ZonaLapak $zonaLapak) {
                $btn = '
                <button type="submit" class="button btn btn-danger" style="display: inline" id="delete" data-id="' . $zonaLapak->id . '">
                <i class="fa fa-trash"></i>
                </button>
            ';

                return $btn;
            })
            ->rawColumns(['action'])
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
        //
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
            'zonaLapak' => 'required'
        ]);

        ZonaLapak::create($request->only('zonaLapak'));

        return \redirect()->route('super_admin.master-zona-lapak.index')->with('message', 'Zona Lapak Berhasil Ditambahkan');
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
        $zonaLapak = ZonaLapak::findOrFail($id);
        $zonaLapak->delete();
        return \response()->json([
            'sukses' => true
        ]);
    }
}
