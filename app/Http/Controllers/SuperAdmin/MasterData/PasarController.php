<?php

namespace App\Http\Controllers\SuperAdmin\Masterdata;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Pasar;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('super_admin.pasar.index');
    }

    public function dtPasar()
    {
        return \datatables()->of(Pasar::latest()->get())
        ->addColumn('action', 'template.partials.DT-action')
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
        Pasar::create($request->only('namaPasar'));
        return \redirect()->route('super_admin.pasar.index')->with('message', 'Data Pasar Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('super_admin.pasar.show', [
            'pasar' => Pasar::findOrFail($id)
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
        return \view('super_admin.pasar.edit', [
            'pasar' => Pasar::findOrFail($id)
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
            'namaPasar' => 'required',
            'alamat' => 'required',
            'penanggungJawab' => 'required'
        ]);

        $pasar = Pasar::findOrFail($id);
        $pasar->update($request->only('namaPasar'));
        return \redirect()->route('super_admin.pasar.index')->with('message', 'Data Pasar Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasar = Pasar::findOrFail($id);
        $pasar->delete();
        return \response()->json(['sukses' => true]);
    }
}
