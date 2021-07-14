<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Lapak;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use Carbon\Carbon;
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

        $pedagang = Pedagang::with('retribusis')->where('status', 'verified')->get();
        foreach($pedagang as $v){
            $latestDate = $v->retribusis->max('tglBayar_retribusi');
            $add3Mounth = Carbon::parse($latestDate)->addMonths(3);

            //sp 1
            $add3Mounth_sp1 = Carbon::parse($latestDate)->addMonths(3);
            $subtract2Weeks = $add3Mounth_sp1->subWeeks(2);

            //sp 2
            $add3Mounth_sp2 = Carbon::parse($latestDate)->addMonths(3);
            $subtract1Weeks = $add3Mounth_sp2->subWeeks(1);

            //sp 3
            $add3Mounth_sp3 = Carbon::parse($latestDate)->addMonths(3);
            $subtract3Days = $add3Mounth_sp3->subDays(3);
            
            $dataPedagang_verified[] = [
                'id' => $v->id,
                'nik' => $v->nik,
                'nama' => $v->nama,
                'latsPay_retribusi' => $latestDate,
                'date3mounth' => $add3Mounth->format('Y-m-d'),
                'sp1' => $subtract2Weeks->format('Y-m-d'),
                'sp2' => $subtract1Weeks->format('Y-m-d'),
                'sp3' => $subtract3Days->format('Y-m-d')
            ];
        }
        
        
        $sp = [];
        foreach($dataPedagang_verified as $data){
            $sp1 = $data['sp1'];
            $sp2 = $data['sp2'];
            $sp3 = $data['sp3'];
            $dateNow = Carbon::now()->addDays(1)->format('Y-m-d');
            // $dateNow = Carbon::parse('2021-10-07')->addDays(1);

            // $retribusi = Retribusi::where([
            //     // ['mPasar_id', '=' ,$this->getMasterPasar()],
            //     ['pedagang_id', '=' ,$data['id']]
            // ])
            // ->whereBetween('tglBayar_retribusi', [$data['latsPay_retribusi'], $dateNow])
            // ->get();

            if ($dateNow > $sp1 && $dateNow < $sp2) {
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateSp' => $data['sp1'],
                    'lastPay' => $data['latsPay_retribusi'],
                    'status' => 'SP 1'
                ];
            } elseif($dateNow > $sp2 && $dateNow < $sp3){
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateSp' => $data['sp2'],
                    'lastPay' => $data['latsPay_retribusi'],
                    'status' => 'SP 2'
                ];
            } elseif($dateNow > $sp3){
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateSp' => $data['sp1'],
                    'lastPay' => $data['latsPay_retribusi'],
                    'status' => 'SP 3'
                ];
            } else {
                $sp[] = '';
            }
        }
        

        return \array_filter($sp, function($value){
            return $value !== '';
        });
    }

    public function __invoke(Request $request)
    {
        // \dd($this->getPeringatan());
        return view('admin.dashboard', [
            'lapaks' => Lapak::where('mPasar_id', $this->getMasterPasar()->id)->get(),
            'pedagangs' => Pedagang::where('mPasar_id', $this->getMasterPasar()->id)->get(),
        ]);
    }

    public function dtPedagangSp()
    {
        $dataPedagang = $this->getPeringatan();
        return \datatables()->of($dataPedagang)
        ->addColumn('action', function($dataPedagang){
            $btn = '<a href="/admin/sp/pedagang/detail/' . $dataPedagang['id'] . '" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Lihat data."><i class="fa fa-eye"></i></a>
            ';
                return $btn;
        })
        ->addColumn('sp', function(){

        })  
        ->rawColumns(['action', 'sp'])
        ->addIndexColumn()
        ->toJson();
    }
}
