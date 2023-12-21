<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "user_devices";
    protected $fillable = ['user_id' , 'token' , 'platform'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
