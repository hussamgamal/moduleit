<?php

namespace Modules\User\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Areas\Models\Area;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\User;

class AdminController extends HelperController
{
    public function __construct()
    {
        $this->role_name = "User";

        $this->model = new User;
        $this->rows = User::whereNull('role_id');

        $this->title = "Users";
        $this->name = 'users';
    }

    public function list_builder()
    {
        $this->list = [
            'name' => 'الاسم',
            'mobile' => 'رقم الجوال',
            'email' => 'البريد الإلكتروني',
        ];
        $this->switches['status'] = route('admin.users.active_status');
    }

    public function form_builder()
    {
        $this->inputs = [
            'name' => ['title' => 'الاسم '],
            'mobile' => ['title' => 'رقم الجوال'],
            'email' => ['title' => 'البريد الإلكتروني'],
            'password' => ['title' => 'كلمة المرور', 'type' => 'password', 'empty' => 1],
            // 'status' => ['title' => 'مفعل', 'type' => 'select', 'values' => boolean_vals()],
            // 'image' => ['title' => '', 'type' => 'image', 'empty' => 1]
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


    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('User::admin.login');
        }
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (auth('admin')->attempt($data, true)) {
            return redirect()->to('/admin');
        }
        return back()->with('error', "بيانات الدخول خاطئة");
    }
}
