<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Setting;
use Modules\User\Models\User;

class AdminController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        $title = __("Home page");
        $counters = [
            [
                'title' => __("Users"),
                'url' => route('admin.users.index'),
                'count' => User::where('type', 'client')->count(),
                'icon' => 'fa-users',
                'type' => 'success',
            ]
        ];
        // $months = range(1, 12);
        // $sales = [];
        // foreach ($months as $month => $month_name) {
        //     $month++;
        //     $sales[] = Aqar::whereMonth('created_at', $month)->count() ?? 0;
        // }
        return view('Common::admin.home', get_defined_vars());
    }

    public function load()
    {
        $title = "";
        return view('Common::admin.load', get_defined_vars());
    }

    public function remove_img()
    {
        \DB::table('attachments')->where('id', request('id'))->delete();
        return 'success';
    }
}
