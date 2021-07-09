<?php

namespace App\Http\Controllers\SuperAdmin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Komoditas;
use Illuminate\Http\Request;

class KomoditasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.masterKomoditas.index');
    }

    public function dtKomoditas()
    {
        return \datatables()->of(Komoditas::latest()->get())
            ->addColumn('action', function (Komoditas $komoditas) {
                $btn = '
                <button type="submit" class="button btn btn-danger" style="display: inline" id="delete" data-id="' . $komoditas->id . '">
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
            'komoditas' => 'required'
        ]);
        Komoditas::create($request->only('komoditas'));
        return \redirect()->route('super_admin.master-komoditas.index')->with('message', 'Data Komoditas Berhasil Ditambahkan');
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
        $komoditas = Komoditas::findOrFail($id);
        $komoditas->delete();
        return \response()->json(['sukses' => true]);
    }
}
