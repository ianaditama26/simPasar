<?php

namespace App\Http\Controllers\Diskomindag;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\Pedagang;
use Illuminate\Http\Request;

class DikomindagController extends Controller
{
    public function dashboard()
    {
        return \view('diskomindag.dashboard');
    }

    public function index()
    {
        return view('diskomindag.index');
    }

    public function dtStatusProsesPedagang()
    {
        $pedagang = Pedagang::with('mPasar', 'lapak')->orderBy('updated_at', 'asc')->get();
        
        return \datatables()->of($pedagang)
        ->addColumn('action', function(Pedagang $pedagang){
            $btn = '
            <a href="/admin/pedagang/' . $pedagang->id . '" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit data."><i class="fa fa-eye"></i></a>
            ';
            return $btn;
        })
        ->rawColumns(['action'])
        ->addIndexColumn()
        ->toJson();
    }

    public function verifiedPedagang($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        $pedagang->update(['status' => 'verified']);
        $pedagang->statusPedagang->update(['isVerified_diskomindag' => 'ok']);
        //ubah status lapak
        $pedagang->lapak->update(['statusLapak' => 1]);
        return \redirect()->back();
    }

    public function deniedPedagang($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        //ubah status pedagang menjadi denied
        $pedagang->update(['status' => 'denied']);
        $pedagang->statusPedagang->update(['isVerified_diskomindag' => 'denied']);
        //ubah status lapak
        $pedagang->lapak->update(['statusLapak' => 0]);
        return \redirect()->back();
    }
}
