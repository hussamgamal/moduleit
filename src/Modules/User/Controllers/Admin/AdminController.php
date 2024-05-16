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
        $this->model = new User;

        $this->role_name = "User";

        $this->title = "Users";
        $this->name = 'users';

        $this->moreActions[] = 'admin_flag';
    }

    public function listBuilder()
    {
        $this->list = [
            'code' => 'الكود',
            'name' => 'الاسم',
            'mobile' => 'رقم الجوال',
            // 'activation_code' => 'كود التفعيل'
            'email' => 'البريد الإلكتروني',
        ];


        $this->switches['status'] = route('admin.users.active_status');

        $this->links = [
            [
                'title' => 'Orders',
                'icon' => 'fa-th-list',
                'url' => route('admin.orders.index'),
                'key' => 'user_id',
                'type' => 'success',
            ],
            [
                'title' => 'Added days',
                'icon' => 'fa-plus',
                'url' => route('admin.added_days'),
                'key' => 'user_id',
                'type' => 'primary',
            ],
        ];
    }


    public function admin_flag($model)
    {
        if ($model->created_at >= date('Y-m-d H:i:s', strtotime('-1 minute'))) {
            $model->update(['added_from' => 'admin']);
        }
    }

    public function formBuilder()
    {
        $areas = [];
        $rows = Area::get();
        foreach ($rows as $row) {
            $areas[$row->id] = $row->name->{app()->getLocale()};
        }
        $this->inputs = [
            'name' => ['title' => 'الاسم '],
            'mobile' => ['title' => 'رقم الجوال'],
            'email' => ['title' => 'البريد الإلكتروني', 'empty' => 1],
            'password' => ['title' => 'كلمة المرور', 'type' => 'password', 'empty' => 1],
            // 'status' => ['title' => 'الحالة', 'type' => 'hidden', 'value' => request('status', 1)],
            'image' => ['title' => 'الصورة', 'type' => 'image', 'empty' => 1],
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
                send_fcm([$device->device_token], $device->device_type, __('Your account activated as provider'), 'provider', $user->id, 'provider');
            }
        }
        $user->update(['status' => $status]);
        return api_response('success', '', ['status' => 1]);
    }

    public function address()
    {
        $user = User::findOrFail(request('user_id'));
        $address = $user->addresses()->latest()->first();
        $data = [
            'age' => $address->info['age'] ?? '',
            'height' => $address->info['height'] ?? '',
            'weight' => $address->info['weight'] ?? '',
            'gender' => $address->info['gender'] ?? '',
            'address' => $address->address ?? [],
            'address_area_id' => $address->area_id ?? '',
            'area_id' => $address->area->area_id ?? '',
            'mobile' => $user->mobile
        ];
        return response()->json($data);
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
