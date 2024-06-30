<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'location.lat' => 'required|numeric|min:-90|max:90',
            'location.lng' => 'required|numeric|min:-180|max:180',
            'address' => 'required|string|max:1000',
            'special_marque' => 'nullable|string|max:200',
        ];
    }
}
