<?php

namespace Modules\Common\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Areas\Models\Area;
use Modules\Categories\Models\Category;
use Modules\Common\Models\Setting;
use Modules\Common\Models\Subscribe;
use Modules\ContactReasons\Models\ContactReason;
use Modules\Features\Models\Feature;
use Modules\Menus\Models\Menu;
use Modules\OurMessages\Models\OurMessage;
use Modules\Pages\Models\Page;
use Modules\Partners\Models\Partner;
use Modules\Plans\Models\Plan;
use Modules\Projects\Models\Project;
use Modules\Services\Models\Service;
use Modules\Sliders\Models\Slider;

class WebController extends Controller
{

    public function index()
    {
        $plans = Plan::sort()->get();
        $menus = Menu::sort()->get();
        $page = $about = Page::where('type' , 'about')->first();
        $features = Feature::sort()->get();
        $partners = Partner::sort()->get();

        $title = __('Home');
        return view("Common::web.home.index", get_defined_vars());
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
