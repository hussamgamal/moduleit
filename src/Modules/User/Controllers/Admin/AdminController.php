<?php

namespace Modules\User\Controllers\Admin;

use Illuminate\Http\Request;
use MshMsh\Helpers\ApiResponder;
use Illuminate\Support\Facades\Auth;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\User\Models\User;

class AdminController extends HelperController
{
    public function __construct()
    {
        $this->model = new User();
        $this->title = "Users";
        $this->name = 'users';
    }

    public function listBuilder()
    {
        $this->list = [
            'name' => 'الاسم',
            'mobile' => 'رقم الجوال',
            'email' => 'البريد الإلكتروني',
        ];
        $this->switches['status'] = route('admin.users.active_status');
    }


    public function formBuilder()
    {
        $this->inputs = [
            'name' => ['title' => 'الاسم '],
            'mobile' => ['title' => 'رقم الجوال'],
            'email' => ['title' => 'البريد الإلكتروني', 'empty' => 1],
            'password' => ['title' => 'كلمة المرور', 'type' => 'password', 'empty' => 1],
            'image' => ['title' => 'الصورة', 'type' => 'image', 'empty' => 1],
        ];
    }

    public function active_status(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->update(['status' => !$user->status]);
        return ApiResponder::loaded(['status' => 1]);
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
            return redirect()->intended('/admin');
        }
        return back()->with('error', "بيانات الدخول خاطئة");
    }

    public function notifications()
    {
        $notifications = auth('admin')->user()->notifications()->latest()->paginate(10);
        $title =   __("notifications") ;
        return view('User::admin.notifications', get_defined_vars());

    }
    public function markNotifyRead()
    {
        $user = auth('admin')->user();
        $notifications = $user->unreadnotifications;
        foreach ($notifications as $notification){
            $notification->markAsRead();
        }
    }
    public function saveToken()
    {
        $token = request()->token;
        $user = auth('admin')->user();
        $user->devices()->updateOrCreate(['token' => $token, 'platform' => request()->platform]);
        return response()->json(['status' => 'success']);
    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }
}
