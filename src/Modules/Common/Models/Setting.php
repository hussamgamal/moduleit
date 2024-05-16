<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'app_settings';

    protected $fillable = ['key', 'value', 'image', 'type'];

    // protected $casts = ['value' => 'array'];
    protected $hidden = ['created_at', 'updated_at'];

    public function scopeContacts($query)
    {
        return $query->whereType('contacts');
    }

    public function scopeSocials($query)
    {
        return $query->whereIn('key', ['whatsapp', 'facebook', 'twitter', 'instagram']);
    }

    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            foreach ($value as $lang => $val) {
                if (is_array($val)) {
                    $rows[$lang] = json_encode($val);
                } elseif (is_uploaded_file($val)) {
                    $rows[$lang] = 'storage/' . $val->store('settings');
                } else {
                    $rows[$lang] = $val;
                }
            }
            $value = json_encode($rows);
        } elseif (is_uploaded_file($value)) {
            $value = 'storage/' . $value->store('settings');
        }
        if ($value) {
            $this->attributes['value'] = $value;
        }
    }

    public function getValueAttribute($value)
    {
        // if($this->key == 'quick_cost') dd($value);
        if (json_decode($value) && strpos(request()->url(), 'admin') === false) {
            $locale = app()->getLocale();
            //test commit 
            return json_decode($value)->$locale ?? json_decode($value)->all ?? $value;
        }
        return json_decode($value) ? json_decode($value) :  $value;
    }

    public function setImageAttribute($image)
    {
        $this->attributes['image'] = 'storage/' . $image->store("settings");
    }

    public function getImageAttribute($image)
    {
        return $image ? url($image) : url('assets/placeholders/icon.png');
    }
}
