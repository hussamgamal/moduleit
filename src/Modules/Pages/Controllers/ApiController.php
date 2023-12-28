<?php

namespace Modules\Pages\Controllers;

use App\Http\Controllers\Controller;
use Modules\Pages\Models\Page;

class ApiController extends Controller
{

    public function index($id = null)
    {
        if ($id) {
            $pages['page'] = Page::where('id', $id)->orWhere('type', $id)->first();
            $pages['socials'] = socials();
        } else {
            $pages = Page::where('type', '!=', 'commission')->get(['id', 'title', 'image']);
        }
        return api_response('success', '', $pages);
    }

    public function about()
    {
        return api_response('success', '', Page::whereType('about')->first());
    }

    public function return_policy()
    {
        return api_response('success', '', Page::whereType('return_policy')->first());
    }

    public function policy()
    {
        return api_response('success', '', Page::whereType('policy')->first());
    }

    public function terms()
    {
        return api_response('success', '', Page::whereType('terms')->first());
    }
}
