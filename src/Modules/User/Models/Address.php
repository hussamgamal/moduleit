<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Areas\Models\Area;

class Address extends Model
{
    protected $table = "user_addresses";
    protected $fillable = ['user_id', 'address', 'location', 'name', 'mobile', 'area_id', 'info', 'status'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'address'   =>  'array',
        'location'  =>  'array',
        'info'  =>  'array',
        'area_id' => 'integer'
    ];

    protected $with = ['area'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id')->select('id', 'area_id', 'name')->with('area');
    }

    public function getLocationAttribute($location)
    {
        $location = json_decode($location);
        return !$location || (is_array($location) && !count($location)) ? null : (array) $location;
    }

    public function getFullAddressAttribute()
    {
        if (isset($this->address['area_id']) && $this->address['area_id'] != $this->area_id) {
            $area = Area::find($this->address['area_id']);
        } else {
            $area = $this->area;
        }
        $area_name = $area->name->ar ?? $area->name ?? '';
        $city_name = $area->area->name->ar ?? $area->area->name ?? '';
        $str = '<li><b>' . __('Area') . '</b> : ' . $city_name . ' , ';
        $str .= '<b>' . __('City') . '</b> : ' . $area_name . '</li>';
        $address = $this->address;
        if (isset($address['area_id']))  unset($address['area_id']);
        $str .= "<li>";
        $trans = [
            'street' => "S",
            'avenue' => "J",
            'block' => "B",
            'house' => "H",
            'level' => "L",
            "flat" => "F"
        ];
        foreach ($address as $key => $val) {
            $key = $trans[$key] ?? $key;
            $str .= '<b>' . __($key) . '</b> : ' . $val . ' , ';
        }
        $str .= "</li>";
        return $str;
    }

    public function getInvoiceFullAddressAttribute()
    {
        if (isset($this->address['area_id']) && $this->address['area_id'] != $this->area_id) {
            $area = Area::find($this->address['area_id']);
        } else {
            $area = $this->area;
        }
        $area_name = $area->name->ar ?? $area->name ?? '';
        $area_name .= " / " . ($area->name->en ?? $area->name ?? '');
        $city_name = $area->area->name->ar ?? $area->area->name ?? '';
        $str = "<span class='address_details' style='list-style-type:none;direction:ltr; text-align:right'>";
        $str .= '(<b>R / منطقة</b> : ' . $area_name . ") <br />";
        $address = $this->address;
        if (isset($address['area_id']))  unset($address['area_id']);
        $trans = [
            'street' => "S / شارع",
            'avenue' => "J / جادة",
            'block' => "B / قطعة",
            'house' => "H / منزل",
            'level' => "L / طابق",
            "flat" => "F / شقة"
        ];
        // $trans = [
        //     'street' => "S",
        //     'avenue' => "J",
        //     'block' => "B",
        //     'house' => "H",
        //     'level' => "L",
        //     "flat" => "F"
        // ];
        foreach ($address as $key => $val) {
            if ($val) {
                $str .= "(";
                $key = $trans[$key] ?? $key;
                // $key .= ' / ' . __($key);
                $str .= ' <b>' . $key . '</b> : ' . $val;
                $str .= ") <br />";
            }
        }
        $str .= "</span>";
        return $str;
    }

    public function getAddressAttribute($address)
    {
        if (json_decode($address)) {
            $address = json_decode($address);
        }
        $address = (array) $address;
        if (isset($address['area_id'])) {
            $address['area_id'] = (int) $address['area_id'];
        }
        return $address;
    }
}
