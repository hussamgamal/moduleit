<?php

namespace Modules\User\Models;

use MshMsh\Actions\DefaultMediaImage;
use MshMsh\Actions\HasActive;
use MshMsh\Actions\HelperModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements HasMedia
{
    use Notifiable,InteractsWithMedia,
        DefaultMediaImage,HelperModel,HasActive;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password','mobile','status','image','banned'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

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

    public function getRoleNameAttribute()
    {
        return @$this->roles->first()['name'];
    }

    public function setPasswordAttribute($pass)
    {
        if ($pass) {
            $this->attributes['password'] = bcrypt($pass);
        }
    }

    public function devices()
    {
        return $this->morphMany(Device::class,'user','user_type','user_id')->latest();
    }
    public function allNotifications()
    {
        return \Modules\Common\Models\Notification::whereDate('created_at','>=',$this->created_at)->where(function($q){
            $q->where('notifiable_id',$this->id)->orWhere(function ($q){
                $q->where('notifiable_id',0)->where('notifiable_type',Admin::class);
            });
        });
    }

}
