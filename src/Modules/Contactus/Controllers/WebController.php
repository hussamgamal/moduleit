<?php

namespace Modules\Contactus\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ContactReasons\Models\ContactReason;
use Modules\Contactus\Models\Contactus;
use Modules\Contactus\Models\MerchantRequest;

class WebController extends Controller
{
    public function contactus(Request $request)
    {
        if (request()->isMethod('get')) {
            switch (request('type')) {
                case 'manage_request':
                    $title = __("Managment Request");
                    break;
                case 'rent_request':
                    $title = __("Rent Request");
                    break;
                case 'pre_book':
                    $title = __('Pre Book');
                    break;
                default:
                    $title = __('Contactus');
                    break;
            }
            $type = 'message';
            $reasons = ContactReason::get();
            return view('Contactus::index', get_defined_vars());
        }
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required_if:type,message|email',
            'mobile' => 'required',
            'message' => 'required_if:type,message',
        ]);
        $data = $request->all();
        Contactus::create($data);
        return back()->with('success', __('Message sent successfully'));
    }

    public function request(Request $request)
    {
        if ($request->isMethod('GET')) {
            $title = __('Request trip');
            $type = "request";
            return view('Contactus::merchant', get_defined_vars());
        }
        MerchantRequest::create($request->all());
        return back()->with('success', __('Your Request Sent Successfully , we will contact you as soon as possible'));
    }
}
