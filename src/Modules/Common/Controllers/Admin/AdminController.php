<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Aqars\Models\Aqar;
use Modules\Aqars\Models\RentRequest;
use Modules\Common\Models\Setting;
use Modules\Contactus\Models\Contactus;
use Modules\Goals\Models\Goal;
use Modules\Jobs\Models\JobRequest;
use Modules\Partners\Models\Partner;
use Modules\Permits\Models\Contractors;
use Modules\Permits\Models\Visitor;
use Modules\Services\Models\Service;
use Modules\Teams\Models\Team;
use Modules\User\Models\Admin;
use Modules\User\Models\User;

class AdminController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        $title = __("Home page");
        $counters = [
            [
                'title' => __("Services"),
                'url' => route('admin.services.index'),
                'count' => Service::where('type', 'main')->count(),
                'icon' => 'fa-th-large',
                'type' => 'success',
            ],
            [
                'title' => __("Health care services"),
                'url' => route('admin.services.index'),
                'count' => Service::where('type', 'health')->count(),
                'icon' => 'fa-guest',
                'type' => 'danger',
            ],
            [
                'title' => __("Partners"),
                'url' => route('admin.partners.index'),
                'count' => Partner::count(),
                'icon' => 'fa-users',
                'type' => 'warning',
            ],
            [
                'title' => __("Our Team"),
                'url' => route('admin.teams.index'),
                'count' => Team::count(),
                'icon' => 'fa-user',
                'type' => 'primary',
            ],
            [
                'title' => __("Booking Requests"),
                'url' => route('admin.contactus.index'),
                'count' => Contactus::count(),
                'icon' => 'fa-envelope',
                'type' => 'warning',
            ],
            [
                'title' => __("Job Requests"),
                'url' => route('admin.jobs.index'),
                'count' => JobRequest::count(),
                'icon' => 'fa-envelope',
                'type' => 'primary',
            ],
            [
                'title' => __("Moderators"),
                'url' => route('admin.moderators.index'),
                'count' => Admin::count(),
                'icon' => 'fa-user',
                'type' => 'success',
            ],
            [
                'title' => __("Goals"),
                'url' => route('admin.goals.index'),
                'count' => Goal::count(),
                'icon' => 'fa-th-list',
                'type' => 'danger',
            ],
        ];

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
