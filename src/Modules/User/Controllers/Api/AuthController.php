<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\Device;
use Modules\User\Models\Token;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;

class AuthController extends Controller
{
    public function myprofile()
    {
        return api_response('success', '', new UserResource(auth('api')->user()));
    }
    public function signup(Request $request)
    {
        $data = request()->all();
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'mobile' => 'required|unique:users,mobile',
            'email' => 'required|unique:users,email|email',
            // 'area_id' => 'required|exists:areas,id'
        ]);
        $data['status'] = 0;
        $user = User::create($data);

        $code = $this->send_confirmation_code($user);

        return api_response('success', 'تم ارسال كود التفعيل الى جوالك', [
            'code' => $code,
            'mobile' => $user->mobile,
        ]);
    }

    public function resend_code(Request $request)
    {
        $user = User::where('mobile', request('mobile'))->first();
        $this->validate($request, [
            'mobile' => 'required|exists:users,mobile',
        ]);
        if (!$user) {
            return \api_response('success', __('This user not found'));
        }
        $code = $this->send_confirmation_code($user);
        return api_response('success', 'تم إعادة إرسال الكود بنجاح', ['mobile' => $request->mobile, 'code' => $code]);
    }

    public function activate(Request $request)
    {
        $token = Token::where('token', $request->code)->latest()->first();
        if (!$token) {
            return api_response('error', __('Activation code is not correct'));
        }
        $user = $token->user;
        $this->add_my_device($user);
        $user->update(['status' => 1]);
        $user->access_token = auth('api')->login($user);

        if ($user->type == 'provider' && $device = $user->device) {
            $message = __("Please complete your profile to be verified");
            send_fcm([$device->token], $device->platform, $message, 'update_profile', $user->id);
        }

        return \api_response('success', __('Your account activated successfully'), new UserResource($user));
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => 'required', 'password' => 'required']);
        if ($token = auth('api')->attempt($request->only('mobile', 'password'))) {
            $user = auth('api')->user();
            if (!$user->status) {
                $code = $this->send_confirmation_code($user);
                return api_response('success', __('Your account is not activated yet , Activation code sent to your mobile'), [
                    'mobile' => $user->mobile,
                    'code' => $code,
                ]);
            }
            $user->access_token = $token;
            return api_response('success', '', new UserResource($user));
        }

        return api_response('error', __('Not correct mobile or password'));
    }

    public function logout()
    {
        $user = auth('api')->user();
        Device::where('user_id', $user->id)->delete();
        return api_response('success', '');
    }

    public function add_my_device($user)
    {
        if (request('device_token')) {
            $device = $user->device()->firstOrCreate([
                'token' => request('device_token'),
                'platform' => request('device_type'),
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
        $this->send_confirmation_code($user);

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

    public function send_confirmation_code($user)
    {
        $code = rand(1000, 9999);
        $code = 1234;
        $user->token()->delete();
        $user->token()->firstOrCreate(['token' => $code]);
        $message = __("Your confirmation code is : ") . $code;
        send_sms($user->mobile, $message);
        return $code;
    }

    public function delete_account()
    {
        $user = auth('api')->user();
        $user->update([
            'mobile' => "DEL::" . time() . "-" . $user->mobile,
            'password' => null,
        ]);
        return api_response('success', 'تم حذف حسابك بنجاح');
    }
}
