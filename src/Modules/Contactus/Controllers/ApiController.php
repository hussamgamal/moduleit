<?php

namespace Modules\Contactus\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Setting;
use Modules\ContactReasons\Models\ContactReason;
use Modules\Contactus\Models\Contactus;

class ApiController extends Controller
{

    public function contactus(Request $request)
    {
        if (request()->isMethod('GET')) {
            $data = [
                'email' => app_setting('email'),
                'mobile' => app_setting('mobile') ?? app_setting('phone'),
                'mobile2' => app_setting('mobile2') ?? app_setting('phone')
            ];
            return \api_response('success', '', $data);
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'nullable|sometimes|email',
            'mobile' => 'required',
            'message' => 'required',
        ]);
        Contactus::create(request()->all());
        if (request('type') == 'manage_request') {
            return api_response('success', __('Request sent successfully'));
        }
        return api_response('success', __("Message sent successfully"));
    }

    public function contact_reasons()
    {
        $rows = ContactReason::get();
        return api_response('success', '', $rows);
    }
}
