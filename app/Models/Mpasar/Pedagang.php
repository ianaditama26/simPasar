<?php

namespace App\Models\Mpasar;

use App\Models\MasterData\Lapak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Pedagang extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected static $logAttributes = ['lapak_id', 'mPasar_id', 'nik', 'nama', 'tempat_tglLahir', 'pekerjaan', 'alamat', 'foto', 'noTelp', 'status'];
    protected static $recordEvents = ['deleted', 'updated', 'created'];

    protected $fillable = ['lapak_id', 'mPasar_id', 'nik', 'nama', 'tempat_tglLahir', 'pekerjaan', 'alamat', 'foto', 'noTelp', 'status'];
    protected $dates = ['deleted_at'];

    //? status => request = request lapak
    //? status => process = request di proses oleh UPT
    //* status => verified = request diterima, pembuatan tgl kontrak dan no izin lapak,
    //! status => revoke => pencabutan,
    //! status => decline => request di tolak

    protected $with = ['mPasar', 'lapak'];

    public function mPasar()
    {
        return $this->belongsTo(MasterPasar::class, 'mPasar_id');
    }

    public function lapak()
    {
        return $this->belongsTo(Lapak::class, 'lapak_id');
    }

    public function getFoto()
    {
        return asset('storage/'.$this->foto);
    }

    public function getStatus()
    {
        if ($this->status == 'request') {
            $status = 'Request Lapak';
        } elseif($this->status == 'verified' ) {
            $status = 'Verified';
        } elseif($this->status == 'decilne' ) {
            $status = 'Decline';
        } else {
            $status = 'Revoke';
        }

        return $status;
    }

    public function kontrakPedagang()
    {
        return $this->hasOne(KontrakPedagang::class, 'pedagang_id');
    }

    public function retribusis()
    {
        return $this->hasMany(Retribusi::class, 'pedagang_id');
    }
}
