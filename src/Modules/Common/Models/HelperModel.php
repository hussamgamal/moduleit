<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Products\Models\Product;
use Modules\User\Models\Rate;
use Modules\User\Models\User;

class HelperModel extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Common relation for all models
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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

    public function getNameAttribute($name)
    {
        if (json_decode($name) && strpos(request()->url(), 'admin') === false) {
            $locale = app()->getLocale();
            return json_decode($name)->$locale;
        }
        return json_decode($name);
    }

    public function getBriefAttribute($brief)
    {
        if (json_decode($brief) && strpos(request()->url(), 'admin') === false) {
            $locale = app()->getLocale();
            return json_decode($brief)->$locale;
        }
        return json_decode($brief);
    }

    public function getTitleAttribute($title)
    {
        if (json_decode($title) && strpos(request()->url(), 'admin') === false) {
            $locale = app()->getLocale();
            return json_decode($title)->$locale;
        }
        return json_decode($title);
    }

    public function getContentAttribute($content)
    {
        $url = request()->url();
        if (json_decode($content) && strpos($url, 'admin') === false) {
            $locale = app()->getLocale();
            // if (strpos($url, 'api') !== false) {
            //     return strip_tags(str_replace("&nbsp;", " ", json_decode($content)->$locale));
            // }
            return json_decode($content)->$locale;
        }
        return json_decode($content) ? json_decode($content) : '';
    }

    public function setImageAttribute($image)
    {
        if (is_uploaded_file($image)) {
            $folder = $this->table ?? strtolower($this->model) ?? 'images';
            $this->attributes['image'] = $image->store("uploads/" . $folder);
            // $this->attributes['image'] = $image->storeAs("uploads/" . $folder, time() . '-' . urlencode($image->getClientOriginalName()));
        }
    }

    public function getImageAttribute($image)
    {
        return $image ? url($image) : url('placeholders/' . $this->table . '.png');
    }

    public function setBannerAttribute($banner)
    {
        $this->attributes['banner'] = $banner->store("uploads/" . $this->table);
    }

    public function getBannerAttribute($banner)
    {
        return $banner ? url($banner) : url('placeholders/banner.png');
    }

    public function rates()
    {
        return $this->morphMany(Rate::class, 'rated')->select('id', 'user_id', 'rate');
    }

    public function getRateAttribute()
    {
        // return 0;
        if ($count = $this->rates()->count()) {
            return round(($this->rates()->sum('rate') / (5 * $count)) * 5, 1);
        }
        return 0;
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notified');
    }

    public function getCreatedAtAttribute($created_at)
    {
        return date('Y-m-d', strtotime($created_at));
    }

    public function model_search($model, $rows , $searchable = null)
    {
        $queries = request()->query();
        foreach (request()->query() as $key => $value) {
            if (in_array($key, $searchable ?? $model->getFillable())) {
                $rows = $rows->when(request()->has($key), function ($query) use ($key, $value) {
                    return $query->where($key, $value);
                });
            }
        }
        if ($word = request('keyword')) {
            if (method_exists($model, 'getSearchable') && $model->getSearchable()) {
                $keys = $model->getSearchable();
                $endcoded_word = str_replace('"', "", json_encode($word));
                $endcoded_word = addslashes($endcoded_word);
                $rows = $rows->where('id', $word);
                foreach ($keys as $index => $key) {
                    $rows = $rows->orWhere(function ($query) use ($key, $word, $endcoded_word) {
                        return $query->where($key, 'like', '%' . $word . '%')->orWhere($key, 'like', '%' . $endcoded_word . '%');
                    });
                }
            } else {
                $keys = $model->getFillable();
                $endcoded_word = str_replace('"', "", json_encode($word));
                $endcoded_word = addslashes($endcoded_word);
                $rows = $rows->where('id', $word);
                foreach ($keys as $index => $key) {
                    $rows = $rows->orWhere(function ($query) use ($key, $word, $endcoded_word) {
                        return $query->where($key, 'like', '%' . $word . '%')->orWhere($key, 'like', '%' . $endcoded_word . '%');
                    });
                }
            }
        }
        return ['model' => $model, 'rows' => $rows];
    }

    public function getValOfKey($row, $col)
    {
        $key = explode('_', $col);
        if (!$row->{$key[0]}) {
            return '';
        } elseif (method_exists($row->{$key[0]}, $key[1])) {
            return $row->{$key[0]}->{$key[1]}();
        }
        $str = $row->{$key[0]}->{$key[1]}->{app()->getLocale()} ?? $row->{$key[0]}->{$key[1]} ?? $row->$col ?? '';
        return is_string($str) ? $str : '';
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
}
