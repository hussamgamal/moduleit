<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Notification;
use Modules\Common\Resources\Notification\NotificationResource;
use MshMsh\Helpers\ApiResponder;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return ApiResponder::failed( 'User not found');
        }
        $notifications = Notification::where('to_user_id', $user->id);
        $notifications = $notifications->whereDate('created_at', '>=', $user->created_at)->latest()->paginate(20);

        $notifications = NotificationResource::collection($notifications);
        return ApiResponder::loaded( $notifications);
    }

    public function seen($id)
    {
        $user = auth()->user();
        $user->seen_notifications()->attach($id);
        return ApiResponder::loaded();
    }

    public function toggle()
    {
        $user = auth()->user();
        $user->update(['notify' => !$user->notify]);
        return ApiResponder::loaded(['notify' => $user->notify]);
    }
}
