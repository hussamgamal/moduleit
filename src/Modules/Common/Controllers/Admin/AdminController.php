<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Setting;
use Modules\Orders\Models\Order;
use Modules\User\Models\User;

class AdminController extends Controller
{
    public function home()
    {
        // $roles = auth()->user()->role->roles ?? [];
        // if (!in_array('Common', $roles)) {
        //     return redirect()->route('admin.subscriptions.index');
        // }
        $title = __("Home page");
        $counters = [
            [
                'title' => __("Orders"),
                'url' => route('admin.orders.index'),
                'count' => Order::count(),
                'icon' => 'fa-th-large',
                'type' => 'primary',
                'role' => "User"
            ],

            [
                'title' => __("Current Orders"),
                'url' => route('admin.orders.index', ['status' => 'current']),
                'count' => Order::current()->count(),
                'icon' => 'fa-th-large',
                'type' => 'success',
                'role' => 'Orders'
            ],
            [
                'title' => __("Today Orders"),
                'url' => route('admin.orders.index', ['status' => 'today']),
                'count' => Order::today()->count(),
                'icon' => 'fa-th-large',
                'type' => 'warning',
                'role' => 'Orders'
            ],
            [
                'title' => __("Users"),
                'url' => route('admin.users.index'),
                'count' => User::count(),
                'icon' => 'fa-users',
                'type' => 'success',
                'role' => 'User'
            ]
        ];
        $roles = auth()->user()->role->roles ?? [];
        foreach ($counters as $key => $count) {
            if (!in_array($count['role'], $roles)) {
                unset($counters[$key]);
            }
        }
        if (in_array("Orders", $roles)) {
            $months = range(1, 12);
            $sales = [];
            foreach ($months as $month => $month_name) {
                $month++;
                $sales[] = Order::whereMonth('started_at', $month)->count() ?? 0;
            }
            $orders = [];
            $latest_orders = Order::whereHas('user', function ($query) {
                return $query->where('name', '!=', 'Guest');
            })->latest()->take(10)->get();
        }

        if (in_array("User", $roles)) {
            $users = User::where('name', '!=', 'Guest')->latest()->take(10)->get();
        }

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
