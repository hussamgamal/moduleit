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
    public function forget(Request $request)
    {
        $this->validate($request, ['mobile' => 'required']);
        $user = User::whereMobile(request('mobile'))->first();
        if (!$user) {
            return api_response('error', __("Mobile not found"));
        }
        (new ConfirmationController)->sendConfirmationCode($user);

        return ApiResponsder::get(__("Reset password code sent to your mobile"), [
            'code' => $user->token->token,
            'mobile' => request('mobile'),
        ]);
    }

    public function resetCode(Request $request)
    {
        $this->validate($request, ['code' => 'required|exists:user_tokens,token']);
        $code = Token::whereToken(request('code'))->first();
        return ApiResponsder::get('', ['code_id' => $code->id]);
    }

    public function reset(Request $request)
    {
        $code = Token::whereToken(request('code'))->orWhere('id', request('code_id'))->first();
        if (!$code) {
            return ApiResponsder::get(__('Reset code is not valid'));
        }
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);
        User::find($code->user_id)->update(['password' => request('password')]);
        $code->delete();
        return ApiResponsder::get(__('Your password changed successfully'));
    }

    public function deleteAccount()
    {
        $user = auth('api')->user();
        $user->update([
            'mobile' => "DEL::" . time() . "-" . $user->mobile,
            'password' => null,
        ]);
        return ApiResponsder::get('تم حذف حسابك بنجاح');
    }
}
