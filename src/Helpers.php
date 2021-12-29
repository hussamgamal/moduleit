<?php
if (!function_exists('api_response')) {
    function api_response($status, $message, $data = null, $status_code = 200)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
        $pagination = api_model_set_pagenation($data);
        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $status_code);
    }
}

if (!function_exists('api_model_set_pagenation')) {

    function api_model_set_pagenation($model)
    {
        if (is_object($model)) {
            try {
                $pagnation['total'] = $model->total();
                $pagnation['lastPage'] = $model->lastPage();
                $pagnation['perPage'] = $model->perPage();
                $pagnation['currentPage'] = $model->currentPage();
                return $pagnation;
            } catch (\Exception$e) {
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

if (!function_exists('send_fcm')) {
    function send_fcm($tokens, $platfrom, $message, $model = 'order', $model_id = null, $type = null, $title = null)
    {
        // dd($tokens, $message, $card_id);
        ob_start();
        $url = "https://fcm.googleapis.com/fcm/send";
        $serverKey = env('fcm_server_key');
        $notification = array(
            'text' => $message,
            'body' => $message,
            'body_ar' => $message,
            'title' => $title ?? 'Foody',
            'title_ar' => $title ?? 'فوودي',
            'type' => $type,
            'model' => $model,
            'id' => $model_id,
            'model_id' => $model_id,
            'sound' => 'default',
            'badge' => '1',
        );
        $tokens = (array) $tokens;
        if ($platfrom == 'ios') {
            $arrayToSend = array('registration_ids' => $tokens, 'notification' => $notification, 'data' => $notification, 'priority' => 'high');
        } else {
            // return true;
            $arrayToSend = array('registration_ids' => $tokens, 'data' => $notification, 'priority' => 'high');
        }
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=' . $serverKey;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //Send the request
        $response = curl_exec($ch);
        // dd($response , $tokens , $platfrom , $json);
        //Close request
        if ($response === false) {
            // die('FCM Send Error: ' . curl_error($ch));
        }
        // dd($json);
        curl_close($ch);
        ob_end_clean();
        return true;
    }
}

if (!function_exists('get_select_data')) {
    function get_select_data($rows, $key = 'id', $value = 'name', $with_main = false)
    {
        $arr = [];
        if ($with_main) {
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
