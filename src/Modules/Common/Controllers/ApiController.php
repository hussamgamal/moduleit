<?php

namespace Modules\Common\Controllers;

use App\Enum\NotifyType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Common\Models\NotificationAction;
use Modules\Common\Resources\Notification\NotificationCollection;
use MshMsh\Helpers\ApiResponsder;

class ApiController extends Controller
{
    public function notifications()
    {
        $user = auth('api')->user();
        $notifications = $user->allNotifications()->latest()->paginate(20);
        return ApiResponsder::loaded([
            'notifications' => NotificationCollection::make($notifications)
        ]);
    }
    public function deleteNotification($uuid)
    {
        $user = auth('api')->user();
        $notification = $user->allNotifications()->where('id',$uuid)->firstOrFail();
        if($notification->notifiable_id > 0){
            $notification->delete();
        }else{
            NotificationAction::create([
                'user_id' => auth('api')->id(),
                'notification_id' => $uuid,
                'type' => NotifyType::DELETE,
            ]);
        }
        return ApiResponsder::deleted();
    }

    public function notifyStatus(Request $request)
    {
        $user = auth('api')->user();
        $user->update([
            'notify' => !$user->notify
        ]);
        return ApiResponsder::updated();
    }
    public function changeLang(Request $request)
    {
        $user = auth('api')->user();
        $user->update([
            'lang' => @$request->lang ?? 'ar'
        ]);
        return ApiResponsder::updated();
    }
}
