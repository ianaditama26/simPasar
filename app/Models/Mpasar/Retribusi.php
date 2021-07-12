<?php

namespace App\Models\Mpasar;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retribusi extends Model
{
    use HasFactory;
    protected $fillable = ['mPasar_id', 'pedagang_id', 'lapak_id', 'tglBayar_retribusi','tarif', 'status'];
    protected $with = ['mPasar', 'pedagang'];

    public function mPasar()
    {
        return $this->belongsTo(MasterPasar::class, 'mPasar_id');
    }

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }

    //tgl terakhir bayar retribusi
    // per 3 bulan subWeeks 2 minggu
    public function getSp1()
    {
        $add3Mounth = Carbon::parse($this->tglBayar_retribusi)->addMonths(3);
        $subtract2Weeks = $add3Mounth->subWeeks(2);
        return $add3Mounth;
    }

    //tgl terakhir bayar retribusi
    // per 3 bulan subWeeks 2 minggu
    public function getSp2()
    {
        $add3Mounth = Carbon::parse($this->tglBayar_retribusi)->addMonth(3);
        $subtract2Weeks = $add3Mounth->subWeekdays(1);
        return $subtract2Weeks->format('Y-m-d');
    }

    //tgl terakhir bayar retribusi
    // per 3 bulan subDays 3 hari
    public function getSp3()
    {
        $add3Mounth = Carbon::parse($this->tglBayar_retribusi)->addMonth(3);
        $subtract2Weeks = $add3Mounth->subDays(3);
        return $subtract2Weeks->format('Y-m-d');
    }
}
