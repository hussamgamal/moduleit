<?php

namespace Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Modules\Pages\Models\Page;

class WebController extends Controller
{

    public function show($id){
        $page = Page::where('id' , $id)->orWhere('type' , $id)->firstOrFail();

        return view('Pages::show' ,get_defined_vars());
    }

}
