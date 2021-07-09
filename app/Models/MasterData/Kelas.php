<?php

namespace App\Models\MasterData;

use App\Models\Mpasar\MasterPasar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = ['kelas'];
    protected $with = ['kelasTarifs'];

    public function kelasTarifs()
    {
        return $this->hasMany(Tarif::class, 'id', 'kelas_id');
    }

    public function mPasar()
    {
        return $this->hasOne(MasterPasar::class, 'id', 'kelas_id');
    }

    protected static function boot()
    {   
        parent::boot();

        static::deleting(function($kelas){
            $kelas->kelasTarifs()->delete();
        });
    }
}
