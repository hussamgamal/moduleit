<?php

namespace Modules\User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            "id" => $this->id,
            "status" => $this->status,
            "user_id" => $this->user_id,
            "name" => $this->name,
            "mobile" => $this->mobile,
            "email" => $this->email,
            "area_id" => $this->area_id,
            "address" => [
                "street" => $this->address['street'] ?? '',
                "block" => $this->address['block_no'] ?? $this->address['block'] ?? '',
                "avenue" => $this->address['avenue'] ?? '',
                "house" => $this->address['house'] ?? '',
                "level" => $this->address['level'] ?? '',
                "flat" => $this->address['flat'] ?? ''
            ],
            "location" => $this->location,
            "info" => [
                "age" => $this->info['age'] ?? $this->info['address']['age'] ?? $this->address['age'] ?? '',
                "weight" => $this->info['weight'] ?? $this->info['address']['weight'] ?? $this->address['weight'] ?? '',
                "height" => $this->info['height'] ?? $this->info['address']['height'] ?? $this->address['height'] ?? '',
                "gender" => $this->info['gender'] ?? $this->info['address']['gender'] ?? $this->address['gender'] ?? ''
            ],
            "area" => $this->area
        ];
    }
}
