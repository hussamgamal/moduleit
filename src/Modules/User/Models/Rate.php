<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = "user_rates";
    protected $fillable = ['rate', 'text' , 'user_id'];

    public function rated(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class)->select('id' , 'name' , 'image');
    }

}
