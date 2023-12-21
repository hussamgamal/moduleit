<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = explode(' ', $this->name);
        return [
            'id'    =>  $this->id,
            'active' => (bool) $this->status,
            'name'  =>  $this->name ?? 'No name',
            'email'   =>   $this->email ?? '',
            'mobile'   =>   $this->mobile ?? '',
            'image' =>  $this->image ?? '',
            'access_token' => $this->access_token
        ];
    }
}
