<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Http\Requests\PedagangRequest;
use App\Models\MasterData\Lapak;
use App\Models\MasterData\ZonaLapak;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PedagangController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function index()
    {
        return view('admin.pedagang.index');
    }

    public function dtPedagang()
    {
        $pedagang = Pedagang::where([
            ['mPasar_id', '=' ,$this->getMasterPasar()->id],
            ['status', '=', 'request']
        ])->orderBy('created_at', 'asc')->get();
        return \datatables()->of($pedagang)
        ->addColumn('action', 'template.partials.DT-action')
        ->addColumn('status', function(Pedagang $pedagang){
            if ($pedagang->status == 'request') {
                $status = '<font style
                ="color:blue;font-weight:bold;">Request Lapak</font>';
            } elseif($pedagang->status == 'verified') {
                $status = '<font style
                ="color:green;font-weight:bold;">Verified</font>';
            }  elseif($pedagang->status == 'delice') {
                $status = '<font style
                ="color:red;font-weight:bold;">Decline</font>';
            } else {
                $status = '<font style
                ="color:yellow;font-weight:bold;">Revoke</font>';
            }

            return $status;
        })
        ->rawColumns(['action', 'status'])
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
        return view('admin.pedagang.create', [
            'mPasar' => $this->getMasterPasar(),
            'lapaks' => Lapak::where([
                ['mPasar_id', $this->getMasterPasar()->id],
                ['statusLapak' ,'=', 0]
            ])->get(),
            'zonasi' => ZonaLapak::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedagangRequest $request)
    {
        $foto = null;

        if ($request->hasFile('foto')) {
            $foto = \request()->file('foto')->store('pedagang/foto');

        }

        $data = array_merge(
            $request->except('_token', 'foto'), \compact('foto')
        );

        $pedagang = Pedagang::create($data);
        //update status lapak = 1
        $pedagang->lapak->update(['statusLapak' => 1]);
        return Redirect::route('admin.pedagang.show', $pedagang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        return \view('admin.pedagang.show', [
            'pedagang' => Pedagang::findOrFail($id)
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
        return \view('admin.pedagang.edit', [
            'pedagang' => Pedagang::findOrFail($id),
            'pasar' => $this->getMasterPasar(),
            'lapaks' => Lapak::where('mPasar_id', $this->getMasterPasar()->id)->get(),
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
    public function update(PedagangRequest $request, Pedagang $pedagang)
    {
        //kalo tidak ada di table maka di set null deafult nya
        $foto = $pedagang->foto ?? null;

        if ($request->hasFile('foto')) {
            Storage::delete($pedagang->foto);
            $foto = $request->file('foto')->store('pedagang/foto');
        }
        $data = array_merge(
            $request->except('_token', 'foto'), \compact('foto')
        );
        //update status lapak lama = 0
        $pedagang->lapak->update(['status' => 0]);

        $pedagang->update($data);
        //update status lapak yang baru = 1
        $pedagang->lapak->update(['status' => 1]);

        return Redirect::route('admin.pedagang.show', $pedagang->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        if ($pedagang->status == 'request') {
            //ambil data imgae
            if ($pedagang->foto) {
                Storage::delete($pedagang->foto);
            }
            $pedagang->lapak->update(['statusLapak' => 0]);
            $pedagang->forceDelete();

            $success = \true;
            $message = 'Data telah dihapus';
        } else {
            $success = \false;
            $message = 'Data pedagang tidak dapat dihapus';
        }
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
