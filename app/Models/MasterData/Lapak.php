<?php

namespace App\Models\MasterData;

use App\Models\Mpasar\MasterPasar;
use App\Models\Mpasar\Pedagang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapak extends Model
{
    use HasFactory;
    protected $fillable = ['mPasar_id', 'tarif' ,'komoditas', 'zonasi', 'noLapak', 'luas', 'statusLapak'];

    protected $with = ['mPasar'];

    // statusLapak = 0 (lapak siap di booking)
    // statusLapak = 1 (booking lapak)

    public function getFormatTarif()
    {
        return \number_format($this->tarif, 0, ',', '.');
    }

    public function mPasar()
    {
        return $this->belongsTo(MasterPasar::class, 'mPasar_id');
    }

    public function pedagang()
    {
        return $this->hasOne(Pedagang::class, 'lapak_id');
    }
}
