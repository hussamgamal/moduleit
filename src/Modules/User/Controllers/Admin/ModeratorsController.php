<?php

namespace Modules\User\Controllers\Admin;

use Modules\User\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\Admin;
use Modules\User\Models\Role;
use Modules\User\Requests\AdminRequest;

class ModeratorsController extends HelperController
{
    public function __construct()
    {
        $this->role_name = "Roles";

        $this->model = new Admin;
        $this->rows = Admin::where('id', '!=', 1);
        $this->title = "Moderators";
        $this->name =  'moderators';

        $this->formRequest = AdminRequest::class;
    }

    public function list_builder()
    {
        $this->list = [
            'name' => 'الاسم',
            'role_name' => 'الصلاحية'
        ];
        $this->switches['status'] = route('admin.users.active_status');
    }

    public function form_builder()
    {
        $roles = Role::pluck('name', 'id');
        $this->inputs = [
            'role_id'  =>  ['title'    =>  'الصلاحية', 'type' => 'select', 'values' => $roles],
            'name'  =>  ['title'    =>  'الاسم'],
            'email'  =>  ['title'    =>  'البريد الإلكترونى'],
            'mobile'  =>  ['title'    =>  'رقم الجوال', 'empty' => 1],
            'password'  =>  ['title'    =>  'كلمة المرور', 'type' => 'password'],
            'image'  =>  ['title'    =>  'الصورة', 'type' => 'image', 'empty' => 1],
        ];
    }

    public function active_status(Request $request)
    {
        $user = User::findOrFail($request->id);
        if ($user->status == 1) {
            $status = 0;
        } else {
            $status = 1;
            if ($user->type == 'provider' && $device = $user->device) {
                send_fcm([$device->token], $device->platform, __('Your account activated as provider'), 'provider', $user->id, 'provider');
            }
        }
        $user->update(['status' => $status]);
        return api_response('success', '', ['status' => 1]);
    }
}
