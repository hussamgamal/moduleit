<?php

namespace Modules\User\Controllers\Admin;

use Modules\User\Models\User;
use Illuminate\Http\Request;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\Role;

class ModeratorsController extends HelperController
{
    public function __construct()
    {
        $this->role_name = "Roles";

        $this->model = new User;
        $this->rows = User::whereHas('role')->where('id', '!=', 1);
        $this->title = "Moderators";
        $this->name =  'moderators';
        $this->list = [
            'name' => 'الاسم',
            'roles_name' => 'الصلاحية'
        ];

        $roles = Role::pluck('name', 'id');
        $this->inputs = [
            'role_id'  =>  ['title'    =>  'الصلاحية', 'type' => 'select', 'values' => $roles],
            'name'  =>  ['title'    =>  'الاسم الأول'],
            'email'  =>  ['title'    =>  'البريد الإلكترونى'],
            'mobile'  =>  ['title'    =>  'رقم الجوال'],
            'orders_per_day'  =>  ['title'    =>  'عدد الطلبات فى اليوم'],
            'password'  =>  ['title'    =>  'كلمة المرور', 'type' => 'password'],
            'image'  =>  ['title'    =>  'الصورة', 'type' => 'image', 'empty' => 1],
        ];
        $this->switches['status'] = route('admin.users.active_status');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role_id'   =>  'required',
            'name'    =>  'required',
            'email'   =>  'required|email|unique:users',
            'mobile' =>  'required|unique:users',
            'password'  =>  'required|min:6',
            'orders_per_day' => 'required|numeric'
        ]);
        $data = $request->all();
        $data['status'] = 1;
        User::create($data);
        return response()->json(['url' => route('admin.moderators.index'), 'message' => 'تم اضافة الموظف بنجاح']);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'role_id'   =>  'required',
            'name'    =>  'required',
            'email'   =>  'required|email|unique:users,email,' . $user->id,
            'mobile' =>  'required|unique:users,mobile,' . $user->id,
            'orders_per_day' => 'required|numeric'
        ]);
        if (request('password')) {
            $this->validate($request, ['password'  =>  'min:6']);
        }
        $user->update($request->all());
        return response()->json(['url' => route('admin.moderators.index'), 'message' => 'تم تعديل بيانات الموظف بنجاح']);
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
