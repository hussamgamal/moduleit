<?php

namespace Modules\Contactus\Controllers;

use App\Http\Controllers\Controller;
use Modules\Contactus\Models\Contactus;

class AdminController extends Controller
{
    public function index()
    {
        $messages = Contactus::latest()->paginate(25);
        $title = "Contactus messages";
        return view('Contactus::admin.list', get_defined_vars());
    }

    public function show($id)
    {
        $message = Contactus::findOrFail($id);
        $message->update(['seen' => 1]);
        $title = "Message Details";
        return view('Contactus::admin.show', get_defined_vars());
    }
}
