<?php

namespace Modules\User\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Modules\User\Controllers\ConfirmationCode;
use Modules\User\Models\User;

class PasswordController extends Controller
{
    public function change(Request $request)
    {
        if ($request->isMethod("GET")) {
            return view("User::password.change");
        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $user = auth()->user();
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', __('Old password not matched'));
        }
        $user->update(['password' => $request->password]);
        return back()->with('success', __('Password changed successfully'));
    }

    public function forget(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view("User::password.forget");
        }
        $request->validate(['mobile' => 'required']);
        if (!User::where('mobile', $request->mobile)->exists()) {
            return back()->with('error', __('This mobile not found'));
        }
        $user = auth()->user();
        ConfirmationCode::send($user);
        $mobile = Crypt::encrypt($user->mobile);
        return redirect()->route('activate', [
            $mobile,
            'route' => route('password.reset', $mobile)
        ]);
    }

    public function reset(Request $request, $mobile)
    {
        if ($request->isMethod("GET")) {
            return view("User::password.reset", compact('mobile'));
        }
        $user = auth()->user();
        if (!$user->token()->where('token', implode('', $request->code))->exists()) {
            return back()->with('error', __('Confirmation code is invalid'));
        }
        return redirect()->route('password.reset', $mobile);
    }

    public function new(Request $request, $mobile)
    {
        $user = User::where('mobile', Crypt::decrypt($mobile))->firstOrFail();
        $request->validate(['password' => 'required|confirmed']);

        $user->update(['password' => $request->password]);
        return redirect()->to('/')->with('success', __('Password changed successfully'));
    }
}
