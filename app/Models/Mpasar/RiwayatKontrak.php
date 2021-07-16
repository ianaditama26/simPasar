<?php

namespace App\Models\Mpasar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatKontrak extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'riwayat_kontraks';
    protected $fillable = ['kontrakPedagang_id', 'riwayat_tglKontrak', 'riwayat_akhirKontrak', 'keterangan', 'status'];
    protected $with = ['kontrak_pedagang'];
    protected $dates = ['deleted_at'];

    public function kontrak_pedagang()
    {
        return $this->belongsTo(KontrakPedagang::class, 'kontrakPedagang_id');
    }
}
