<?php

namespace App\Models\Mpasar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKontrak extends Model
{
    use HasFactory;
    protected $fillable = ['kontrakVerifikasi_id', 'riwayat_tglKontrak', 'riwayat_akhirKontrak', 'keterangan'];
    protected $with = ['kontrak_pedagang'];

    public function kontrak_pedagang()
    {
        return $this->belongsTo(KontrakPedagang::class, 'kontrakVerifikasi_id');
    }
}
