<?php

namespace Modules\Contactus\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Common\Controllers\HelperController;
use Modules\Contactus\Models\Contactus;

class AdminController extends HelperController
{
    public function __construct()
    {
        $this->model = new Contactus();
        $this->title = request('type') == 'report' ? "Claims" : "Contactus";
        $this->name = 'contactus';
    }

    public function form_builder()
    {
        $this->inputs = [
            'name' => ['title' => 'الاسم'],
            'email' => ['title' => 'البريد الإلكتروني'],
            'mobile' => ['title' => 'رقم الجوال'],
            'message' => ['title' => '', 'type' => 'textarea'],
            'user_id' => ['title' => '', 'type' => 'hidden', 'value' => auth()->id()]
        ];
    }

    public function index()
    {
        $type = request('type', 'contactus');
        $messages = Contactus::when($type, function ($query, $val) {
            return $query->where('type', $val);
        })->latest()->paginate(25);
        $title = $this->get_title($type);
        return view('Contactus::admin.list', get_defined_vars());
    }

    public function show($id)
    {
        $message = Contactus::findOrFail($id);
        $message->update(['seen' => 1]);
        $title = $this->get_title($message->type);
        return view('Contactus::admin.show', get_defined_vars());
    }

    public function get_title($type)
    {
        switch ($type) {
            case 'report':
                $title = "Claims";
                break;
            default:
                $title = "Contactus messages";
                break;
        }
        return $title;
    }


    public function contact_administration()
    {
        $title = __('Contact the administration');
        // app_setting('contact_administration')
        return view('Contactus::admin.contact_administration', get_defined_vars());
    }
}
