<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    =>  $this->id,
            'rate'  =>  $this->rate,
            'test'  =>  $this->text,
            'user'  =>  $this->user,
            'created_at'    =>  date('M d - h:i a' , strtotime($this->created_at))
        ];
    }
}
