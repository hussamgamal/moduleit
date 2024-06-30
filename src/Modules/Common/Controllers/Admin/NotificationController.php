<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\AdminNotifications;
use App\Notifications\AdminTopicNotifications;
use Illuminate\Support\Facades\Notification;
use Modules\Common\Models\AdminNotification;
use Modules\User\Models\User;

class NotificationController extends Controller
{
    public function notifications($id = null)
    {
        if (request()->isMethod('get')) {
            return $this->view();
        }
        AdminNotification::create(request()->all());
        Notification::send(User::first() , new AdminTopicNotifications(request('for'), request('title') ,request('content')));
        return response()->json(['url' => route('admin.notifications'), 'message' => __('Notification sent successfully')]);
    }

    private function view()
    {
        $notifications = AdminNotification::latest()->paginate(10);
        $title = "Notifications";
        return view('Common::admin.notifications', get_defined_vars());
    }

    public function notifications_delete($id)
    {
        AdminNotification::find($id)->delete();
        return response()->json(['url' => route('admin.notifications'), 'message' => __('Notification deleted successfully')]);
    }
}
