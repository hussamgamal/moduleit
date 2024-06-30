<?php

namespace Modules\Common\Resources\Notification;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'collection' => NotificationResource::collection($this->collection),
            'pagination' => [
                'total'         => $this->total(),
                'count'         => $this->count(),
                'per_page'      => $this->perPage(),
                'current_page'  => $this->currentPage(),
                'total_pages'   => $this->lastPage(),
            ],
        ];

    }
}
