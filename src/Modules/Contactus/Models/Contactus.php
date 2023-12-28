<?php

namespace Modules\Contactus\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Aqars\Models\Aqar;
use Modules\AqarUnits\Models\AqarUnit;
use Modules\ContactReasons\Models\ContactReason;
use Illuminate\Database\Eloquent\Builder;
use Modules\User\Models\User;

class Contactus extends Model
{
    protected $table = 'contactus';
    protected $fillable = [
        'type',
        'name',
        'mobile',
        'email',
        'message',
        'seen',
        'extra_info',
        'reason_id',
        'user_id',
        'aqar_id',
        'unit_id'
    ];

    protected static function booted()
    {
        if (str_contains(request()->url(), '/admin')) {
            static::addGlobalScope('forme', function (Builder $builder) {
                $builder->forme();
            });
        }
    }

    public function scopeForme($query)
    {
        if (!auth()->user()->role_id) {
            return $query->where('user_id', auth()->user()->id);
        }
    }

    protected $casts = ['extra_info' => 'array'];

    public function scopeUnseen($query)
    {
        return $query->where('seen', null);
    }
    public function getCreatedAtAttribute($created_at)
    {
        return date('Y-m-d', strtotime($created_at));
    }

    public function reason()
    {
        return $this->belongsTo(ContactReason::class, 'reason_id');
    }

    public function getExtraInfoAttribute($info)
    {
        $info = json_decode($info);
        if (isset($info->unit_id)) {
            return AqarUnit::find($info->unit_id);
        } elseif (isset($info->aqar_id)) {
            return Aqar::find($info->aqar_id);
        }
        return null;
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aqar()
    {
        return $this->belongsTo(Aqar::class);
    }
}
