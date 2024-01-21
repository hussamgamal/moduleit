<?php

namespace Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Aqars\Models\AddRequest;
use Modules\Aqars\Models\Aqar;
use Modules\Cards\Models\Card;
use Modules\Common\Models\HelperModel;
use Modules\Permits\Models\Contractors;
use Modules\Permits\Models\Visitor;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    public function setImageAttirubte($img)
    {
        $this->attributes['image'] = 'storage/' . $img->store('users');
    }

    public function getValOfKey($row, $col)
    {
        return (new HelperModel())->getValOfKey($row, $col);
    }

    public function token()
    {
        return $this->hasOne(Token::class);
    }

    public function visitPermits()
    {
        return $this->hasMany(Visitor::class);
    }

    public function workerPermits()
    {
        return $this->hasMany(Contractors::class)->whereNull('tools');
    }

    public function toolsPermits()
    {
        return $this->hasMany(Contractors::class)->whereNotNull('tools');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function seen_notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notification_seen', 'user_id', 'notification_id');
    }

    public function getMynotificationsAttribute()
    {
        return Notification::where('type', 'global')->orWhere('user_id', $this->id)->latest();
    }

    public function getUnreadNotificationsAttribute()
    {
        $seen = $this->seen_notifications()->pluck('notification_id')->toArray();
        return $this->mynotifications->whereNotIn('notification_id', $seen)->count();
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function payment_transfer()
    {
        return $this->hasMany(PaymentTransfer::class);
    }

    public function units()
    {
        return $this->hasMany(Aqar::class);
    }

    public function addAqarRequest()
    {
        return $this->hasMany(AddRequest::class);
    }
}
