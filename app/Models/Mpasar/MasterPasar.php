<?php

namespace App\Models\Mpasar;

use App\Models\MasterData\Kelas;
use App\Models\MasterData\Lapak;
use App\Models\MasterData\Pasar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPasar extends Model
{
    use HasFactory;
    protected $table = 'master_pasars';
    protected $fillable = ['pasar_id', 'kelas_id', 'alamat', 'jenisPasar', 'penanggungJawab'];
    protected $with = ['pasar', 'kelas'];

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    public function kelas ()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function lapaks()
    {
        return $this->hasMany(Lapak::class);
    }

    public function pedagangs()
    {
        return $this->hasMany(Pedagang::class);
    }

    public function getInisialPasar()
{
    $name = $this->pasar->namaPasar;
    $name_array = explode(' ',trim($name));

    $firstWord = $name_array[0];
    $middleWord = $name_array[1];
    $lastWord = $name_array[count($name_array)-1];
    $lastCharacter =  $lastWord[\strlen($lastWord)-1];

    return mb_substr($firstWord[0],0,1)."".\mb_substr($middleWord[0],0,1)."".mb_substr($lastWord[0],0,1.)."".$lastCharacter;
}
}
