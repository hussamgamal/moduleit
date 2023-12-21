<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Setting;

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
        $lang_inputs = [
            'title' => ['title' => 'عنوان التطبيق', 'setting' => 1],
            'keywords' => ['title' => 'الكلمات الدلالية', 'setting' => 1],
            'logo' => ['title' => 'اللوجو', 'type' => 'image', 'setting' => 1],
            'favicon' => ['title' => 'ايقونة المتصفح', 'type' => 'image', 'setting' => 1],
        ];
        $action = route('admin.settings.app');
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
        $lang_inputs = [
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
}
