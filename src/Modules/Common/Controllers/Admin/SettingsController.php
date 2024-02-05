<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Setting;
use Modules\Orders\Controllers\Api\DateController;
use Modules\Orders\Models\OrderDate;

class SettingsController extends Controller
{
    public function settings()
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
            }
            return response()->json(['url' => route('admin.settings.app'), 'message' => 'تم تعديل الإعدادات بنجاح']);
        }
        $langInputs = [
            'title' => ['title' => 'عنوان التطبيق', 'setting' => 1],
            'keywords' => ['title' => 'الكلمات الدلالية', 'setting' => 1],
        ];
        $inputs = [
            'logo' => ['title' => 'اللوجو', 'type' => 'image', 'setting' => 1],
            'favicon' => ['title' => 'ايقونة المتصفح', 'type' => 'image', 'setting' => 1],
        ];

        $action = route('admin.settings.app');
        $method = 'post';
        $title = __("Settings");
        $model = new Setting;
        return view('Common::admin.form', get_defined_vars());
    }

    public function home()
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
            }
            return response()->json(['url' => route('admin.settings.home'), 'message' => 'تم تعديل الإعدادات بنجاح']);
        }
        $langInputs = [
            'intro_title' => ['title' => 'عنوان بداية الموقع', 'setting' => 1],
            'intro_sub_title' => ['title' => 'العنوان الفرعي لبداية الموقع', 'setting' => 1],
            'intro_content' => ['title' => 'وصف بداية الموقع', 'setting' => 1]
        ];
        $inputs = [
            'intro_image' => ['title' => 'صورة بداية الموقع', 'type' => 'image', 'setting' => 1]
        ];

        $action = route('admin.settings.home');
        $method = 'post';
        $title = __("Settings");
        $model = new Setting;
        return view('Common::admin.form', get_defined_vars());
    }

    public function app_links()
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
            }
            return response()->json(['url' => route('admin.settings.app_links'), 'message' => 'تم تعديل الإعدادات بنجاح']);
        }
        $langInputs = [
            'android' => ['title' => 'رابط الاندرويد', 'setting' => 1],
            'ios' => ['title' => 'رابط ال IOS', 'setting' => 1],
        ];
        $action = route('admin.settings.app_links');
        $method = 'post';
        $title = __("App Links");
        $model = new Setting;
        return view('Common::admin.form', get_defined_vars());
    }

    public function messages()
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'messages'])->update(['value' => $value]);
            }
            return response()->json(['url' => route('admin.settings.messages'), 'message' => __("Info saved successfully")]);
        }
        $groups = [
            __("Email") => [
                'mail_mailer' => ['title' => 'نوع المرسل', 'setting' => 1],
                'mail_host' => ['title' => 'Host', 'setting' => 1],
                'mail_port' => ['title' => 'Port', 'setting' => 1],
                'mail_username' => ['title' => 'اسم المستخدم', 'setting' => 1],
                'mail_password' => ['title' => 'كلمة السر', 'setting' => 1],
                'mail_encryption' => ['title' => 'التشفير', 'setting' => 1],
                'mail_from_address' => ['title' => 'بريد المرسل', 'setting' => 1],
                'mail_from_name' => ['title' => 'اسم المرسل', 'setting' => 1],
            ],
            __("SMS") => [
                'sms_username' => ['title' => 'اسم المستخدم', 'setting' => 1],
                'sms_password' => ['title' => 'كلمة السر', 'setting' => 1],
                'sms_sender' => ['title' => 'اسم المرسل', 'setting' => 1],
            ],
        ];
        $action = route('admin.settings.messages');
        $title = __("Message settings");
        $model = new Setting;
        $method = 'post';
        return view('Common::admin.form', get_defined_vars());
    }

    public function contacts()
    {
        if (request()->isMethod('get')) {
            $action = route('admin.settings.contacts');
            $method = 'post';
            $title = __('Contacts');
            $model = new Setting;
            $contacts = Setting::whereType('contacts')->get();
            // dd($contacts);
            return view('Common::admin.settings.contacts', get_defined_vars());
        }
        $keys = array_filter(request('key'));
        $values = request('value');
        $images = request('image');
        foreach ($keys as $i => $key) {
            $setting = Setting::firstOrCreate(['key' => $key, 'type' => 'contacts']);
            $values && isset($values[$i]) && $values[$i] ? $setting->value = ['all' => $values[$i]] : '';
            $images && isset($images[$i]) && $images[$i] ? $setting->image = $images[$i] : '';
            $setting->save();
        }
        return response()->json(['url' => route('admin.settings.contacts'), 'message' => __('Info saved successfully')]);
    }

    public function remove_contact()
    {
        Setting::findOrFail(request('id'))->delete();
        return 'success';
    }

    public function store()
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
            }
            if (!isset($data['off_days'])) {
                Setting::firstOrCreate(['key' => 'off_days', 'type' => 'settings'])->update(['value' => null]);
            }
            return response()->json(['url' => route('admin.settings.store'), 'message' => 'تم تعديل الإعدادات بنجاح']);
        }
        $vals = delivery_times();
        $inputs = [
            'delivery_times[]' => ['title' => 'مواعيد التواصيل', 'type' => 'select', 'multiple' => 'multiple', 'values' => $vals, 'setting' => 1],
            'active_day_after' => ['title' => 'عدد الايام المسموح بها اضافة الوجبات بعد تاريخ اليوم', 'type' => 'number', 'setting' => 1],
            // 'off_days[]' => ['title' => 'الايام الاوف الاجبارية', 'type' => 'select', 'setting' => 1, 'multiple' => 'multiple', 'values' => week_days()],
        ];
        $langInputs = [
            'am_txt' => ['title' => 'نص صباحاً', 'setting' => 1],
            'pm_txt' => ['title' => 'نص مساءاً', 'setting' => 1],
            'night_txt' => ['title' => 'نص ليلي', 'setting' => 1],
        ];
        $action = route('admin.settings.store');
        $method = 'post';
        $title = __("Settings");
        $model = new Setting;
        $model->id = 1;
        return view('Common::admin.form', get_defined_vars());
    }

    public function days_off(Request $request)
    {
        if (request()->isMethod('post')) {
            $data = request()->except('_token');
            foreach ($data as $key => $value) {
                Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
            }
            $order_dates = OrderDate::whereNotIn('status', ['cancelled', 'stopped'])
                ->where('date', '>=', $request->stop_from)
                ->where('date', '<=', $request->stop_to)
                ->has('order')
                ->get();
            // dd($order_dates);
            foreach ($order_dates as $date) {
                (new DateController)->date_status($request, $date, null, false);
            }
            return response()->json(['url' => route('admin.settings.days_off'), 'message' => 'تم تعديل الإعدادات بنجاح']);
        }
        $inputs = [
            'stop_from' => ['title' => 'ايقاف من', 'type' => 'date', 'setting' => 1],
            'stop_to' => ['title' => 'ايقاف إلى', 'type' => 'date', 'setting' => 1]
        ];
        $action = route('admin.settings.days_off');
        $method = 'post';
        $title = __("Settings");
        $model = new Setting;
        $model->id = 1;
        return view('Common::admin.form', get_defined_vars());
    }
}
