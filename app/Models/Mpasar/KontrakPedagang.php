<?php

namespace App\Models\Mpasar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class KontrakPedagang extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logAttributes = ['pedagang_id', 'mPasar_id', 'noIzin_pedagang', 'tglKontrak', 'akhirKontrak', 'status'];

    protected $fillable = ['pedagang_id', 'mPasar_id', 'noIzin_pedagang', 'tglKontrak', 'akhirKontrak', 'status'];
    protected $dates = ['deleted_at'];

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id')->withTrashed();
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
