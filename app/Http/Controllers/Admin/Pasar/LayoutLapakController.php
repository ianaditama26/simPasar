<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Lapak;
use App\Models\Mpasar\MasterPasar;
use Illuminate\Http\Request;

class LayoutLapakController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function index()
    {
        $lapaks = Lapak::with('mPasar')->where('mPasar_id', $this->getMasterPasar()->id)->get();
        
        return view('admin.lapak.layout');
    }
}
