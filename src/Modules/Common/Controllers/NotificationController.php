<?php

namespace Modules\Common\Controllers;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Notification;
use Modules\Plans\Models\Period;
use Modules\User\Models\Device;
use Modules\User\Models\User;

class NotificationController extends Controller
{
    public function app_notifications()
    {
        $notifications = Notification::forme()->latest()->paginate(20);
        $title = __('Notifications');

        return view('Common::admin.notifications', get_defined_vars());
    }

    public function index()
    {
        $notifications = Notification::general()->latest()->paginate(20);
        $title = "Notifications";
        return view('Common::admin.notifications', get_defined_vars());
    }

    public function resend($id)
    {
        $row = Notification::findOrFail($id)->toArray();
        unset($row['id'], $row['created_at'], $row['updated_at']);
        $period_id = $row['model_id'];
        $row['title'] = (array) json_decode($row['title']);
        $row['text'] = (array) json_decode($row['text']);

        return $this->send($row);
    }

    public function send($row = null)
    {
        $data = $row ?? request()->all();
        $period_id = request('period_id', $period_id ?? 'all') != 'all' ? request('period_id') : null;
        $data = array_filter($data);
        $data['type'] = 'general';
        $data['model_id'] = $period_id;
        $data['text'] = $data['message'];
        Notification::create($data);

        foreach ($locales ?? [] as $locale) {
            $message = [
                'title' => $data['title'][$locale],
                'message' => $data['text'][$locale],
            ];
            $users = User::where('lang', $locale)->pluck('id')->toArray();
            $devices = Device::whereIn('user_id', $users)
                ->pluck('device_token')
                ->toArray();
            $devices = implode(',', $devices);
            send_fcm($devices, $message, 'general');
        }

        return response()->json(['url' => route('admin.notifications'), 'message' => __('Notification sent successfully')]);
    }

    public function notifications_delete($id)
    {
        Notification::find($id)->delete();
        return response()->json(['url' => route('admin.notifications'), 'message' => __('Notification deleted successfully')]);
    }
}
