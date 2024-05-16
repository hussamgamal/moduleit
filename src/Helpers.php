<?php

use MshMsh\Helpers\Sidebar;

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

if (!function_exists('contact_types')) {
    function contact_types()
    {
        $types = [];
        foreach (contact_keys() as $key) {
            $types[$key] = __($key);
        }
        return $types;
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

        return strpos($val, 'storage/') !== false ? url($val) : $val;
    }
}

if (!function_exists('sidebar')) {
    function sidebar()
    {
        return Sidebar::list();
    }
}

if (!function_exists('admin_actions')) {
    function admin_actions()
    {
        return ['list', 'add', 'edit', 'delete'];
    }
}

if (!function_exists('page_types')) {
    function page_types()
    {
        return [
            'page' => "Normal page",
            'terms' => "Policy & Rules",
            'policy' => 'Privacy Policy',
            'about' => 'About'
        ];
    }
}
