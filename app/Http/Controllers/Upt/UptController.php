<?php

namespace App\Http\Controllers\Upt;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\Pedagang;
use Illuminate\Http\Request;

class UptController extends Controller
{
    public function dashboard()
    {
        return \view('upt.dashboard');
    }

    public function index()
    {
        return view('upt.pedagang.index');
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

    public function idVerified_upt($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        $pedagang->statusPedagang->update(['isVerified_upt' => 'ok']);
        return \redirect()->back();
    }

    public function deniedPedagang($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        $pedagang->statusPedagang->update(['isVerified_upt' => 'denied']);
        return \redirect()->back();
    }
}
