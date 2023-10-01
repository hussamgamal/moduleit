<?php
if (!function_exists('api_response')) {
    function api_response($message = '', $data = null, $status = true, $status_code = 200)
    {
        if ($status_code == 422) {
            if ($data && count($data)) {
                $message = $data[array_key_first($data)];
                $data = null;
            }
        }
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
        if (is_array($data)) {
            foreach ($data as $key => $row) {
                $pagination = api_model_set_pagenation($row);
                if ($pagination) {
                    $response['pagination'] = $pagination;
                    try {
                        $response['data'][$key] = $row->toArray()['data'];
                    } catch (\Throwable $th) {
                        //throw $th;
                        $response['data'][$key] = $row;
                    }
                }
            }
        } else {
            $pagination = api_model_set_pagenation($data);
            if ($pagination) {
                $response['pagination'] = $pagination;
            }
        }
        $status_code = 200;
        return response()->json($response, $status_code);
    }
}

if (!function_exists('api_model_set_pagenation')) {

    function api_model_set_pagenation($model)
    {
        if (is_object($model)) {
            $query_paramters = request()->query();
            unset($query_paramters['page']);
            $query_paramters = http_build_query($query_paramters);
            try {
                $pagnation['total'] = $model->total();
                $pagnation['lastPage'] = $model->lastPage();
                $pagnation['total_pages'] = $model->lastPage();
                $pagnation['perPage'] = $model->perPage();
                $pagnation['currentPage'] = $model->currentPage();
                $pagnation['next_page_url'] = ($url = $model->nextPageUrl()) ? $url . '&' . $query_paramters : null;
                $pagnation['prev_page_url'] = ($url = $model->previousPageUrl()) ? $url . '&' . $query_paramters : null;
                return $pagnation;
            } catch (\Throwable $e) {
            }
        }
        return null;
    }
}

if (!function_exists('boolean_vals')) {
    function boolean_vals()
    {
        return ['No', 'Yes'];
    }
}

if (!function_exists('week_days')) {
    function week_days()
    {
        $days = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];
        foreach ($days as $day) {
            $mydays[$day] = __($day);
        }
        return $mydays;
    }
}

if (!function_exists('hours')) {
    function hours($index = -1)
    {
        $hours = [
            '0' => '12 ' . __('am'),
            '1' => '1 ' . __('am'),
            '2' => '2 ' . __('am'),
            '3' => '3 ' . __('am'),
            '4' => '4 ' . __('am'),
            '5' => '5 ' . __('am'),
            '6' => '6 ' . __('am'),
            '7' => '7 ' . __('am'),
            '8' => '8 ' . __('am'),
            '9' => '9 ' . __('am'),
            '10' => '10 ' . __('am'),
            '11' => '11 ' . __('am'),
            '12' => '12 ' . __('pm'),
            '13' => '1 ' . __('pm'),
            '14' => '2 ' . __('pm'),
            '15' => '3 ' . __('pm'),
            '16' => '4 ' . __('pm'),
            '17' => '5 ' . __('pm'),
            '18' => '6 ' . __('pm'),
            '19' => '7 ' . __('pm'),
            '20' => '8 ' . __('pm'),
            '21' => '9 ' . __('pm'),
            '22' => '10 ' . __('pm'),
            '23' => '11 ' . __('pm'),
        ];
        if ($index == null) {
            return '';
        }

        return $index > -1 ? $hours[$index] : $hours;
    }
}

if (!function_exists('admin_roles')) {
    function admin_roles()
    {
        $modules = glob(base_path("Modules/*"));
        foreach ($modules as $module) {
            $module = array_reverse(explode('/', $module))[0];
            if (strpos($module, '.php') === false) {
                $roles[] = $module;
            }
        }
        foreach ($roles as $role) {
            if (!in_array($role, ['Addresses'])) {
                $rows[$role] = $role;
            }
        }
        return $rows;
    }
}

if (!function_exists('curl_post')) {
    function curl_post($url, $fields)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Content-Type: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = json_encode($fields);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;
    }
}

if (!function_exists('get_select_data')) {
    function get_select_data($rows, $key = 'id', $value = 'name', $main = false)
    {
        $arr = [];
        if ($main) {
            $arr[0] = __('Main');
        }
        foreach ($rows as $row) {
            $arr[$row->$key] = is_object($row->$value) ? $row->$value->{app()->getLocale()} : $row->$value;
        }
        return $arr;
    }
}

if (!function_exists('round_me')) {
    function round_me($val, $length = 2)
    {
        $val = (float) sprintf('%0.2f', $val);
        return $val < 0 ? 0 : $val;
    }
}

if (!function_exists('ar_date_to_en')) {
    function ar_date_to_en($date)
    {
        $months = array(
            'January' => 'يناير',
            'February' => 'فبراير',
            'March' => 'مارس',
            'April' => 'أبريل',
            'May' => 'مايو',
            'June' => 'يونيو',
            'July ' => 'يوليو',
            'August' => 'أغسطس',
            'September' => 'سبتمبر',
            'October' => 'أكتوبر',
            'November' => 'نوفمبر',
            'December' => 'ديسمبر',
        );
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $num = array_reverse(range(0, 9));
        // dd($arabic , array_reverse($num));
        foreach ($months as $month) {
            if (strpos($date, $month) !== false) {
                $key = array_search($month, $months);
                $date = str_replace($arabic, $num, $date);
                return str_replace($month, $key, $date);
            }
        }
        return $date;
    }
}

if (!function_exists('contact_keys')) {
    function contact_keys()
    {
        return ['email', 'mobile', 'facebook', 'twitter', 'instagram', 'pinterest', 'youtube', 'snapchat', 'whatsapp', 'tiktok'];
    }
}

if (!function_exists('social_keys')) {
    function social_keys()
    {
        return ['facebook', 'twitter', 'instagram', 'pinterest', 'youtube', 'snapchat', 'whatsapp', 'tiktok'];
    }
}

if (!function_exists('socials')) {
    function socials()
    {
        $rows = \Modules\Common\Models\Setting::whereIn('key', social_keys())->get();
        return $rows;
    }
}

if (!function_exists('app_setting')) {
    function app_setting($key, $default = null)
    {
        $row = \Modules\Common\Models\Setting::where('key', $key)->first();
        $locale = app()->getLocale();
        if (!$row) {
            return $default;
        }
        $val = "";
        // if($key == 'lat') dd('sss');
        if (!is_object($row->value) && $value = json_decode($row->value)) {
            if (!is_object($value)) {
                return $value;
            }

            $val = $value->all ?? $value->{$locale} ?? $value->ar ?? $value ?? '';
        } else {
            $val = $row->value->all ?? $row->value->{$locale} ?? $row->value->ar ?? $row->value ?? '';
        }
        if (!is_string($val)) {
            return "";
        }

        return strpos($val, 'uploads/') !== false ? url($val) : $val;
    }
}

if (!function_exists('sidebar')) {
    function sidebar()
    {
        require_once base_path('Modules/sidebar.php');
        $roles = auth()->user()->roles ?? [];
        // dd($roles);
        foreach ($links as $key => $link) {
            if (is_string($key)) {
                if (!in_array($key, $roles)) {
                    unset($links[$key]);
                }
            } elseif (isset($link['links'])) {
                $sub_links = $link['links'];
                foreach ($sub_links as $ken => $len) {
                    if (!in_array($ken, $roles)) {
                        unset($sub_links[$ken]);
                    }
                }
                if (count($sub_links)) {
                    $link['links'] = $sub_links;
                    $links[$key] = $link;
                } else {
                    unset($links[$key]);
                }
            }
        }
        return $links;
    }
}
