<?php

namespace Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Modules\OurMessages\Models\OurMessage;
use Modules\Pages\Models\Page;

class WebController extends Controller
{

    public function show($id)
    {
        if ($id == 'about') {
            $our_messages = OurMessage::get();
            $title = __('Aboutus');
            return view('Pages::index', get_defined_vars());
        }
        $page = Page::where('id', $id)->orWhere('type', $id)->firstOrFail();

        return view('Pages::show', get_defined_vars());
    }
}
