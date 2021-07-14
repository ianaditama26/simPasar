<?php

namespace App\Models\Mpasar;

use App\Models\MasterData\Lapak;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retribusi extends Model
{
    use HasFactory;
    protected $fillable = ['mPasar_id', 'pedagang_id', 'lapak_id', 'noFaktur' ,'tglBayar_retribusi','tarif', 'status'];
    protected $with = ['mPasar', 'pedagang', 'lapak'];

    public function mPasar()
    {
        return $this->belongsTo(MasterPasar::class, 'mPasar_id');
    }

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }

    public function lapak()
    {
        return $this->belongsTo(Lapak::class, 'lapak_id');
    }
}
