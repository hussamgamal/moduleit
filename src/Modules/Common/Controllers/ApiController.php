<?php

namespace Modules\Common\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Setting;
use MshMsh\Helpers\ApiResponsder;

class ApiController extends Controller
{

    public function home()
    {
        $rows = [];
        return ApiResponsder::get('', $rows);
    }


    public function settings()
    {
        $keys = array_merge(['mobile', 'whatsapp', 'email'], social_keys());
        
        $rows = Setting::whereIn('key', $keys)->get();
        $arr = [];
        foreach ($rows as $row) {
            $arr[$row->key] = (string) app_setting($row->key);
        }
        return ApiResponsder::get("", $arr);
    }
}
