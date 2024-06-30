<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Contactus\Models\Contactus;
use Modules\Orders\Models\Order;
use Modules\Products\Models\Product;
use Modules\Services\Models\Service;
use Modules\User\Models\User;

class AdminController extends Controller
{
    public function home()
    {
        $title = __("Home page");
        $counters = [
            [
                'title' => __("Users"),
                'url' => route('admin.users.index'),
                'count' => User::count(),
                'icon' => 'fa-users',
                'type' => 'success'
            ],
            [
                'title' => __("Contactus"),
                'url' => route('admin.contactus.index', ['type' => 'message']),
                'count' => Contactus::count(),
                'icon' => 'fa-th-large',
                'type' => 'orange'
            ]
        ];
        $users = User::latest()->get();

        $users = User::latest()->take(10)->get();
        $locale = app()->getLocale();

        $months = range(1, 12);
        $sales = [];
        foreach ($months as $month => $month_name) {
            $month++;
            $sales[] = 0;
        }
        return view('Common::admin.home', get_defined_vars());
    }


    public function load()
    {
        $title = "";
        return view('Common::admin.load', get_defined_vars());
    }
}
