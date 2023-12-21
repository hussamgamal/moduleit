<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'user_tokens';
    protected $fillable = ['token'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
