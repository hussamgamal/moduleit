<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['user_id' ,'user_type' , 'token' , 'platform','uuid'];

    public function user(){
        return $this->morphTo('user');
    }
}
