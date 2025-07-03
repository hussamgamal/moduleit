<?php

namespace Modules\Contactus\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Controllers\Admin\HelperController;
use Modules\Contactus\Models\Contactus;

class AdminController extends HelperController
{

    public function __construct()
    {
        $this->model = new Contactus();
        $this->title = "Contact Us";
        $this->name =  'contactus';
        $this->list = ['name' => 'الاسم','mobile'=>'الجوال','created_at'=>'تم الانشاء'];
    }

    public function show($id)
    {
        $message = Contactus::findOrFail($id);
        $message->update(['seen' => 1]);
        $title = "Message Details";
        return view('Contactus::admin.show', get_defined_vars());
    }
}
