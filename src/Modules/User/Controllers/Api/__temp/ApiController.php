<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Orders\Models\Order;
use Modules\User\Models\Address;
use Modules\User\Models\Device;
use Modules\User\Models\User;
use Modules\User\Resources\AddressResource;
use Modules\User\Resources\UserResource;

class ApiController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user = User::where('id', $user->id)->first();
        // $user->access_token = auth('api')->login($user);
        return api_response('success', '', new UserResource($user));
    }

    public function change_password(Request $request)
    {
        $user = auth('api')->user();
        if (($user->social_id && $user->password) || !$user->social_id) {
            if (!\Hash::check(request('old_password'), $user->password)) {
                return api_response('error', __("Old password not matched"));
            }
        }
        $this->validate($request, [
            'password' => 'required|min:6',
        ]);
        $user->update(['password' => request('password')]);
        return api_response('success', __('Your password changed successfully'));
    }

    public function update(Request $request)
    {
        $user = auth('api')->user();
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|nullable|unique:users,email,' . $user->id,
            'mobile' => 'required|unique:users,mobile,' . $user->id,
        ]);
        $user->update(request()->all());

        $user->access_token = auth('api')->login($user);
        return api_response('success', __("Profile updated successfully"), new UserResource($user));
    }

    public function contacts(Request $request)
    {
        $user = auth('api')->user();
        $address = $user->addresses()->latest()->first() ?? new Address();
        if ($request->isMethod('GET')) {
            // $orders = Order::get();
            // foreach ($orders as $order) {
            //     if ($address = $order->address) {
            //         $address->update([
            //             'info' => [
            //                 'age' => $order->age,
            //                 'weight' => $order->weight,
            //                 'height' => $order->height,
            //                 'gender' => $order->gender
            //             ]
            //         ]);
            //     }
            // }
            return api_response('success', '', new AddressResource($address));
        }
        $data = request(['name', 'mobile', 'address', 'location', 'area_id']);
        $data['info'] = request([
            'age',
            'weight',
            'height',
            'gender',
        ]);
        $data['area_id'] = request('area_id') ?? request('address')['area_id'] ?? null;
        if ($address = $user->addresses()->latest()->first()) {
            $address->update($data);
        } else {
            $address = $user->addresses()->create($data);
        }
        return api_response('success', __('Contact info saved successfully'), new AddressResource($address));
    }


    public function delete_account()
    {
        $user = auth('api')->user();
        if ($user->orders()->valid()->active()->exists()) {
            return api_response('error', __("You can not delete your account until your order ended"));
        }
        $user->update(['status' => -1]);
        Device::where('user_id', $user->id)->delete();
        return api_response('success', __('Your account deleted successfully'));
    }
}
