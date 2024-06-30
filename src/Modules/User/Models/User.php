<?php

namespace Modules\User\Models;

use App\Enum\NotifyType;
use App\Traits\DefaultMediaImage;
use App\Traits\HasActive;
use App\Traits\WalletRelations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Areas\Models\Area;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use Notifiable,InteractsWithMedia,
        DefaultMediaImage,
        HasApiTokens,
        SoftDeletes,HasActive,WalletRelations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'status',
        'mobile',
        'new_mobile',
        'password',
        'lang',
        'banned',
        'type',
        'wallet',
        'notify',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:Y-m-d h:i a',
            'password' => 'hashed',
            'banned' => 'boolean',
            'notify' => 'boolean',
            'status' => 'boolean'
        ];
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function otps()
    {
        return $this->hasMany(Otp::class);
    }
    public function getMycodeAttribute()
    {
        return @Otp::where('user_id', $this->id)->where('status',false)->whereDate('expired_at','>',Carbon::now()->format('Y-m-d'))->first()->otp;
    }
    public function scopeOtpCode($value)
    {
        return $value->otps()->where('status',false)->whereDate('expired_at','>',Carbon::now()->format('Y-m-d'));
    }
    public function setImageAttribute($image)
    {
        if (is_uploaded_file($image)) {
            $this->clearMediaCollection('image');
            $this->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }
    }

    public function getImageAttribute()
    {
        return $this->getFirstOrDefaultMediaUrl('image');
    }
    public function allNotifications()
    {
        return \Modules\Common\Models\Notification::whereDate('created_at','>=',$this->created_at)->where(function($q){
            $q->where('notifiable_id',$this->id)->orWhere(function ($q){
                $q->where('notifiable_id',0)->where('notifiable_type',User::class);
            });
        })->wheredoesnthave('notificationActions',fn($q)=>$q->where('user_id',$this->id)->where('type',NotifyType::DELETE))->with(['notificationActions'=>fn($q)=>$q->where('user_id',$this->id)]);
    }
    public function getFullPhoneAttribute()
    {
        return '966' . ltrim(@$this->attributes['mobile'], '0');
    }
    public function devices()
    {
        return $this->morphMany(Device::class,'user','user_type','user_id')->latest();
    }


    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function myrates()
    {
        return $this->morphMany(Rate::class, 'rated');
    }

    public function getMyrateAttribute()
    {
        return number_format($this->myrates()->avg('rate'), 1);
    }



}
