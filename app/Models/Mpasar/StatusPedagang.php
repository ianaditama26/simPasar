<?php

namespace App\Models\Mpasar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPedagang extends Model
{
    use HasFactory;
    protected $guarded = [];

    //? isProcess_pasar = 1 = request lapak telah diperoses
    //* isVerified_upt = 1 = request lapak telah verifikasi
    //* isVerified_diskomindag = 1 = request lapak telah verifikasi

    public function pedagang()
    {
        return $this->belongsTo(Pedagang::class, 'pedagang_id');
    }
}
