<?php

namespace Modules\User\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Aqars\Models\Aqar;
use Modules\Aqars\Resources\AqarsResource;
use Modules\Common\Models\Notification;
use Modules\Common\Resources\NotificationResource;
use Modules\User\Models\User;
use Modules\User\Resources\UserResource;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return api_response('error', 'User not found');
        }
        $notifications = Notification::where('to_user_id', $user->id);
        $notifications = $notifications->whereDate('created_at', '>=', $user->created_at)->latest()->paginate(20);

        $notifications = NotificationResource::collection($notifications);
        return api_response('success', '', $notifications);
    }

    public function seen($id)
    {
        $user = auth()->user();
        $user->seen_notifications()->attach($id);
        return api_response('success', '');
    }
    
    public function toggle()
    {
        $user = auth()->user();
        $user->update(['notify' => !$user->notify]);
        return api_response('success', '', ['notify' => $user->notify]);
    }
}
