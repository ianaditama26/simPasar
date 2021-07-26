<?php

namespace App\Http\Controllers\Admin\pasar;

use App\Http\Controllers\Controller;
use App\Models\Mpasar\KontrakPedagang;
use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use App\Models\Mpasar\Retribusi;
use Carbon\Carbon;

class PelanggaranPedagangController extends Controller
{
    public function getMasterPasar()
    {
        $masterPasar = MasterPasar::where('pasar_id', \auth()->user()->pasar_id)->first();
        return $masterPasar;
    }

    public function getPeringatan()
    {

        $pedagang = Pedagang::with('retribusis', 'kontrakPedagang')->where([
            ['mPasar_id', '=', $this->getMasterPasar()->id],
            ['status', '=','verified']
        ])->get();
        
        foreach($pedagang as $v){
            $latsPay = $v->retribusis->max('tglBayar_retribusi');
            $add3Mounth = Carbon::parse($latsPay)->addMonths(3);

            //sp 1
            $add3Mounth_sp1 = Carbon::parse($latsPay)->addMonths(3);
            $subtract2Weeks = $add3Mounth_sp1->subWeeks(2);

            //sp 2
            $add3Mounth_sp2 = Carbon::parse($latsPay)->addMonths(3);
            $subtract1Weeks = $add3Mounth_sp2->subWeeks(1);

            //sp 3
            $add3Mounth_sp3 = Carbon::parse($latsPay)->addMonths(3);
            $subtract3Days = $add3Mounth_sp3->subDays(3);
            
            $dataPedagang_verified[] = [
                'id' => $v->id,
                'nik' => $v->nik,
                'nama' => $v->nama,
                'latsPay_retribusi' => $latsPay,
                'tglKontrak' => $v->kontrakPedagang->tglKontrak,
                'date3mounth' => $add3Mounth->format('Y-m-d'),
                'sp1' => $subtract2Weeks->format('Y-m-d'),
                'sp2' => $subtract1Weeks->format('Y-m-d'),
                'sp3' => $subtract3Days->format('Y-m-d')
            ];
        }
        
        //! peringatan sp retribusi
        //* $dataPedagang_verified = [];
        $sp = [];
        foreach($dataPedagang_verified as $data){
            $sp1 = $data['sp1'];
            $sp2 = $data['sp2'];
            $sp3 = $data['sp3'];
            $dateNow = Carbon::now()->addDays(1)->format('Y-m-d');
            $TglKontrak_add1Mounth = Carbon::parse($data['tglKontrak'])->diffInDays();
            // $dateNow = Carbon::parse('2021-10-07')->addDays(1);
            if ($data['latsPay_retribusi'] == '' && $TglKontrak_add1Mounth > 29) {
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateWarning' => $data['tglKontrak'],
                    'keterangan' => 'Pedagang belum menempati lapak selama '.$TglKontrak_add1Mounth.' hari',
                    'status' => 'Pencabutan'
                ];
            } elseif ($dateNow > $sp1 && $dateNow < $sp2) {
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateWarning' => $data['sp1'],
                    'keterangan' => 'Pedagang belum membayar tagihan retribusi selama '.Carbon::parse($data['latsPay_retribusi'])->diffInDays().' hari',
                    'status' => 'SP 1'
                ];
            } elseif($dateNow > $sp2 && $dateNow < $sp3){
                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateWarning' => $data['sp2'],
                    'keterangan' => 'Pedagang belum membayar tagihan retribusi selama '.Carbon::parse($data['latsPay_retribusi'])->diffInDays().' hari',
                    'status' => 'SP 2'
                ];
            } elseif($dateNow > $sp3){

                $sp[] = [
                    'id' => $data['id'],
                    'nik' => $data['nik'],
                    'name' => $data['nama'],
                    'dateWarning' => $data['sp1'],
                    'keterangan' => 'Pedagang belum membayar tagihan retribusi selama '.Carbon::parse($data['latsPay_retribusi'])->diffInDays().' hari.',
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

    public function index()
    {
        return view('admin.pelanggaran.index');
    }

    public function prosesRequest_lapak($id)
    {
        $pedagang = Pedagang::findOrFail($id);
        $pedagang->statusPedagang->update(['isProcess_pasar' => 'ok']);
        return \redirect()->back();
    }
}
