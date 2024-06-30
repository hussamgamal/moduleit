<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class HelperModel extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Common relation for all models
     */

    /**
     * Common setter
     * @image
     * @name
     * @brief
     */

    public function getSlugAttribute()
    {
        if ($this->title) {
            return $this->id . '-' . str_replace([' ', '/'], '-', $this->title);
        } elseif ($this->name) {
            return $this->id . '-' . str_replace([' ', '/'], '-', $this->name);
        }
        return $this->id;
    }


    public function getRateAttribute()
    {
        // return 0;
        if ($count = $this->rates()->count()) {
            return number_format(($this->rates()->sum('rate') / (5 * $count)) * 5, 1);
        }
        return 0;
    }

    public function getCodeAttribute($code)
    {
        if (!$code) {
            if ($this->id) {
                $code = 1000 + $this->id;
            } else {
                $code = ($this->latest()->first()->id ?? 0) + 10001;
            }
        }
        return $code;
    }

    public function scopeNearest($query, $latitude, $longitude)
    {
        $query->select("*")
            ->selectRaw(
                "(6371 *
                acos(cos(radians($latitude)) *
                cos(radians(location->>'$.lat')) *
                cos(radians(location->>'$.lng') -
                radians($longitude)) +
                sin(radians($latitude)) *
                sin(radians(location->>'$.lat'))))
                AS distance"
            )
            ->orderBy("distance", "asc");
    }

    public function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    public function scopeSort($query)
    {
        return $query->orderBy('sort', 'asc');
    }


    public function getCryptedIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

    public function getShortAttribute($val)
    {
        if ($val) return $val;
        return strip_tags(str_replace('&nbsp;', ' ', $this->content));
    }
}
