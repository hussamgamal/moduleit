<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;
use MshMsh\Helpers\ApiResponder;

class ApiController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user = User::where('id', $user->id)->first();
        // $user->access_token = auth()->login($user);
        return ApiResponder::loaded(new UserResource($user));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
            'email' => 'email|nullable|unique:users,email,' . $user->id,
            // 'mobile' => 'required|unique:users,mobile,' . $user->id,
        ]);
        $user->update($data);

        $user->access_token = auth()->login($user);
        return ApiResponder::loaded(new UserResource($user));
    }

    public function edit_mobile(Request $request)
    {
        $user = auth()->user();
        if ($request->mobile != $user->mobile) {
            $request->validate([
                'mobile' => 'required|unique:users,mobile,' . $user->id,
            ]);
            $user->update([
                'new_mobile' => $request->mobile
            ]);
            $code = (new AuthController)->send_confirmation_code($user);
            return ApiResponder::loaded(['code' => $code, 'mobile' => $request->mobile],200,__('Confirmation code sent to your new mobile'));
        }
        return ApiResponder::failed(__("Your number not changed"));
    }

    public function confirm_new_mobile(Request $request)
    {
        $user = auth()->user();
        $this->validate($request, [
            'code' => 'required'
        ]);
        if (!$user->token()->where('token', $request->code)->exists()) {
            return ApiResponder::failed(__('Confirmation code is not correct'));
        }
        $user->update([
            'mobile' => $user->new_mobile,
            'new_mobile' => null
        ]);
        return ApiResponder::loaded();
    }


    public function change_password(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'
        ]);
        if (!\Hash::check($request->old_password, $user->password)) {
            return ApiResponder::failed(__('Old password not matched'));
        }
        $user->update([
            'password' => $request->new_password
        ]);
        return ApiResponder::loaded(null,200,__('Password changed successfully'));
    }

    public function contacts(Request $request)
    {
        $user = auth()->user();
        $address = $user->addresses()->first();
        if ($request->isMethod('GET')) {
            return ApiResponder::loaded($address);
        }
        $data = request(['name', 'mobile', 'address', 'location', 'area_id']);
        $data['info'] = request([
            'age',
            'weight',
            'height',
            'gender',
        ]);
        if ($address = $user->addresses()->first()) {
            $address->update($data);
        } else {
            $address = $user->addresses()->create($data);
        }
        return ApiResponder::loaded($address,200, __('Contact info saved successfully'));
    }


}
