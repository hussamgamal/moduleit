<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\Device;
use Modules\User\Models\Token;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;
use MshMsh\Helpers\ApiResponsder;

class AuthController extends Controller
{
    public function myprofile()
    {
        return ApiResponsder::get('', new UserResource(auth('api')->user()));
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

        $code = (new ConfirmationController)->sendConfirmationCode($user);

        return ApiResponsder::get('success', 'تم ارسال كود التفعيل الى جوالك', [
            'code' => $code,
            'mobile' => $user->mobile,
        ]);
    }

    public function login(Request $request)
    {
        $request->validate(['mobile' => 'required', 'password' => 'required']);
        if ($token = auth('api')->attempt($request->only('mobile', 'password'))) {
            $user = auth('api')->user();
            if (!$user->status) {
                $code = (new ConfirmationController)->sendConfirmationCode($user);
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

    public function addMyDevice($user)
    {
        if (request('device_token')) {
            $device = $user->device()->firstOrCreate([
                'token' => request('device_token'),
                'platform' => request('device_type'),
            ]);
            Device::where('user_id', $user->id)->where('id', '!=', $device->id)->delete();
        }
    }
}
