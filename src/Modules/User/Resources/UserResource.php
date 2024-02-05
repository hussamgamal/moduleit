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
        $name = explode(' ' , $this->name);
        return [
            'id'    =>  $this->id,
            'active' => true,
            'type' => $this->type,
            'first_name'    =>  $name[0] ?? '',
            'last_name' =>  $name[1] ?? '',
            'name'  =>  $this->name ?? '',
            'email'   =>   $this->email ?? '',
            'mobile'   =>   $this->mobile ?? '',
            'gps' =>  $this->gps ? true : false,
            'image' =>  $this->image ?? '',
            'access_token' => $this->access_token
        ];
    }
}
