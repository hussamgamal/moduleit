<?php

namespace Modules\Common\Models;

use App\Traits\DefaultMediaImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia,DefaultMediaImage;
    protected $table = 'app_settings';

    protected $fillable = ['key', 'value',  'type'];

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
                } else {
                    $rows[$lang] = $val;
                }
            }
            $value = json_encode($rows);
        }
        if (!is_uploaded_file($value)) {
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


}
