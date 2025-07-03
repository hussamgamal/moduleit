<?php

namespace Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Modules\Pages\Models\Page;
use MshMsh\Helpers\ApiResponder;

class ApiController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
            $pages = Page::where('id' , $id)->orWhere('type' , $id)->first();
        } else {
            $pages = Page::get(['id', 'title', 'image']);
        }
        return ApiResponder::loaded($pages);
    }

    public function about()
    {
        return ApiResponder::loaded(Page::whereType('about')->first());
    }

    public function return_policy()
    {
        return ApiResponder::loaded(Page::whereType('return_policy')->first());
    }

    public function policy()
    {
        return ApiResponder::loaded(Page::whereType('policy')->first());
    }

    public function terms()
    {
        return ApiResponder::loaded(Page::whereType('terms')->first());
    }
}
