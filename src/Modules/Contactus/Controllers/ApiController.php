<?php

namespace Modules\Contactus\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Setting;
use Modules\Contactus\Models\Contactus;

class ApiController extends Controller
{

    public function contactus(Request $request)
    {
        if (request()->isMethod('GET')) {
            return \api_response('success', '', Setting::where('type', 'contacts')->get()->pluck('value' , 'key')->toArray());
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|sometimes|email',
            'mobile' => 'required',
            'message' => 'required',
        ]);
        Contactus::create(request()->all());
        return api_response('success', __("Message sent successfully"));
    }

    public function refund_request(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|sometimes|email',
            'mobile' => 'required',
            'message' => 'required',
            'order_id' => 'required|exists:orders,id',
        ]);
        $data = request()->all();
        $data['type'] = 'refund';
        Contactus::create($data);
        return api_response('success', __("Request sent successfully"));
    }

}
