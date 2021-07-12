<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Lapak;
use App\Models\MasterData\Pasar;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function getPeringatan()
    {
        $lastPay_retribtion = Retribusi::where([
            ['mPasar_id', '=', $this->getMasterPasar()->id],  
        ])->latest('tglBayar_retribusi')->get();
        foreach($lastPay_retribtion as $lastPay){
            $dateLastPay[] = $lastPay->getSp1();
        }

        return $dateLastPay;
    }

    public function __invoke(Request $request)
    {
        \dd($this->getPeringatan());
        return view('admin.dashboard', [
            'lapaks' => Lapak::where('mPasar_id', $this->getMasterPasar()->id)->get(),
            'pedagangs' => Pedagang::where('mPasar_id', $this->getMasterPasar()->id)->get()
        ]);
    }
}
