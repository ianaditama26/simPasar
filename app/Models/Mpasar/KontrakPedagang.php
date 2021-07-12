<?php

namespace App\Models\Mpasar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KontrakPedagang extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['pedagang_id', 'mPasar_id', 'noIzin_pedagang', 'tglKontrak', 'akhirKontrak', 'status'];

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }

    public function mPasar()
    {
        return $this->belongsTo(MasterPasar::class, 'mPasar_id');
    }

    public function riwayatKontraks()
    {
        return $this->hasMany(RiwayatKontrak::class, 'kontrakPedagang_id');
    }
}
