<?php

namespace App\Http\Controllers\Admin\Pasar;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Kelas;
use App\Models\MasterData\Pasar;
use App\Models\Mpasar\MasterPasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MasterPasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('admin.pasar.index', [
            'pasar' => Pasar::with('mPasar.user')->where('id', \auth()->user()->pasar_id)->first(),
            'classes' => Kelas::with('kelasTarifs')->get(),
            'dataMasterPasar' => MasterPasar::with('pasar', 'kelas')->where('pasar_id', \auth()->user()->pasar_id)->first()
        ]);
    }

    public function dtPendaftaranPedagang()
    {
        $selectPasar = DB::table('')->where('pasar_id')->get();
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
            'pasar_id' => 'required',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'penanggungJawab' => 'required'
        ]);

        MasterPasar::updateOrCreate([
            'pasar_id' => \auth()->user()->pasar_id,
        ], $request->except('_token'));

        return \redirect()->route('admin.pasar.index');
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
        //
    }
}
