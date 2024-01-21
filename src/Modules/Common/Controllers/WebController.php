<?php

namespace Modules\Common\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\Setting;
use Modules\Common\Models\Subscribe;
use Modules\Opinions\Models\Opinion;
use Modules\Pages\Models\Page;
use Modules\Partners\Models\Partner;
use Modules\Services\Models\Service;
use Modules\Sliders\Models\Slider;
use Modules\Teams\Models\Team;

class WebController extends Controller
{

    public function index()
    {
        $sliders = Slider::sort()->get();
        $main_services = Service::where('type' , 'main')->sort()->get();
        $healthy_services = Service::where('type' , 'healthy')->sort()->get();
        $team = Team::sort()->get();
        $partners = Partner::sort()->get();
        $opinions = Opinion::sort()->get();
        return view('Common::home' , get_defined_vars());
        
    }

    public function policy()
    {
        $page = Page::where('type', 'policy')->first() ?? new Page;
        $socials = Setting::socials()->get();
        return view('Common::policy', get_defined_vars());
    }

    public function Subscribe(Request $request)
    {
        if (!$request->email) {
            return back()->with('error', __('Email is required'));
        }
        Subscribe::firstOrCreate(['email' => $request->email]);
        return back()->with('success', __('Your email added to newsletter successfully'));
    }
}
