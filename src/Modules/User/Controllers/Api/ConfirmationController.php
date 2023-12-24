<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\Token;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;
use MshMsh\Notifications\Channels\SMS;

class ConfirmationController extends Controller
{
    public function activate(Request $request)
    {
        $token = Token::where('token', $request->code)->latest()->first();
        if (!$token) {
            return api_response('error', __('Activation code is not correct'));
        }
        $user = $token->user;
        $this->addMyDevice($user);
        $user->update(['status' => 1]);
        $user->access_token = auth('api')->login($user);

        if ($user->type == 'provider' && $device = $user->device) {
            $message = __("Please complete your profile to be verified");
            send_fcm([$device->token], $device->platform, $message, 'update_profile', $user->id);
        }

        return \api_response('success', __('Your account activated successfully'), new UserResource($user));
    }

    public function resendCode(Request $request)
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

    public function sendConfirmationCode($user)
    {
        $code = rand(1000, 9999);
        $code = 1234;
        $user->token()->delete();
        $user->token()->firstOrCreate(['token' => $code]);
        $message = __("Your confirmation code is : ") . $code;
        $user->notify(new SMS($message));
        return $code;
    }
}
