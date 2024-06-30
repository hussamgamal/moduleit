<?php

namespace Modules\Common\Resources\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => (string) @$this['title'][app()->getLocale()],
            'message' => (string) @$this['message'][app()->getLocale()],
            'type' => @$this['type'] ?? ''
        ];
    }
}
