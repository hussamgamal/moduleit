<?php
namespace MshMsh\Actions;

use Modules\Common\Models\Setting;

trait Setter
{
    public function setData($type)
    {
        $data = request()->except('_token');
        foreach ($data as $key => $value) {
            Setting::firstOrCreate(['key' => $key, 'type' => 'settings'])->update(['value' => $value]);
        }
        return response()->json(['url' => route('admin.settings.' . $type), 'message' => 'تم تعديل الإعدادات بنجاح']);
    }
    public function formBuilder($type, $data)
    {
        extract($data);
        $action = route('admin.settings.' . $type);
        $method = 'post';
        $title = __("Settings");
        $model = new Setting;
        $isSetting = true;
        return view('Common::admin.form', get_defined_vars());
    }
}
