<?php

namespace App\Models\MasterData;

use App\Models\Mpasar\MasterPasar;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory;
    protected $fillable = ['namaPasar'];
    protected $with = ['mPasar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mPasar()
    {
        return $this->hasOne(MasterPasar::class, 'id', 'pasar_id');
    }
}
