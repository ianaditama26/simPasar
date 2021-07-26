<?php

namespace App\Models;

use App\Models\MasterData\Pasar;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected static $logAttributes = ['name', 'email'];
    protected static $recordEvents = ['deleted', 'updated', 'created'];
    protected static $logName = 'user';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'pasar_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['pasar'];

    public function pasar()
    {
        return $this->hasOne(Pasar::class, 'id', 'pasar_id');
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "You have {$eventName} user data";
    }
}
