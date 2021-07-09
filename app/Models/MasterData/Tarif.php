<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $fillable = ['tarif', 'zonasi'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
