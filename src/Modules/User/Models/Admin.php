<?php

namespace Modules\User\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Common\Models\HelperModel;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'mobile'
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getValOfKey($row, $col)
    {
        return (new HelperModel())->getValOfKey($row, $col);
    }
}
