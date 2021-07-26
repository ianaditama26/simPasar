<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Lapak;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Laravel\LavachartsFacade;

class DashboardController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function getChartCount_retributionPerMonth()
    {
        $retribution = Retribusi::where([
            ['mPasar_id' ,'=', \auth()->user()->pasar_id]
        ])
        ->select(DB::raw('count(id) as `data`'), 
        DB::raw('sum(tarif) as `sumTarif`'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"),)
        ->groupby('monthyear')
        ->get();
        return $retribution;
    }

    public function getSumRetribusi_perWeek()
    {
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d');

        $retribution = Retribusi::where([
            ['mPasar_id' ,'=', $this->getMasterPasar()->id],
        ])
        ->whereBetween('tglBayar_retribusi', [$weekStartDate, $weekEndDate])
        ->select([
            DB::raw('sum(tarif) as sumTarif'),
            DB::raw('date(tglBayar_retribusi) as date'),
        ])
        ->groupBy('date')
        ->get()
        ->keyBy('date');

        return $retribution;
    }

    public function getSumRetribusi_perBulan()
    {
        $now = Carbon::now();
        $monthStartDate = $now->startOfYear()->format('Y-m-d');
        $monthEnddate = $now->endOfYear()->format('Y-m-d');

        $retributions = Retribusi::where([
            ['mPasar_id' ,'=', $this->getMasterPasar()->id],
        ])
        ->whereBetween('tglBayar_retribusi', [$monthStartDate, $monthEnddate])
        ->select([
            DB::raw('count(id) as data'),
            DB::raw('sum(tarif) as sumTarif'),
            DB::raw('month(tglBayar_retribusi) as month'),
        ])
        ->groupBy('month')
        ->get()
        ->keyBy('month');

        return $retributions;
    }

    public function getSumRetribusi_perHari()
    {
        $retribution = Retribusi::where([
            ['mPasar_id' ,'=', \auth()->user()->pasar_id]
        ])
        ->select(DB::raw("CONCAT_WS('-',DAY(created_at),YEAR(created_at)) as day"))
        ->selectRaw('SUM(tarif) as total_tarif')
        ->whereRaw('Date(tglBayar_retribusi) = CURDATE()')
        ->groupby('day')
        ->get();

        return $retribution;
    }

    public function __invoke(Request $request)
    {
        // \dd($this->getSumRetribusi_perBulan());
        return view('admin.dashboard', [
            'lapaks' => Lapak::where([
                ['mPasar_id', '=', $this->getMasterPasar()->id],
            ])->get(),
            'pedagangs' => Pedagang::where([
                ['mPasar_id', '=', $this->getMasterPasar()->id],
            ])->get(),
            'pedagang_nonActive' => Pedagang::onlyTrashed()->get(),
            'retribusi_perWeeks' => $this->getSumRetribusi_perWeek(),
            'retribusi_perMonths' => $this->getSumRetribusi_perBulan()
        ]);
    }
}
