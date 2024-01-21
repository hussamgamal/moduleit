<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'mobile' =>  ['nullable', 'regex:/^05[0-9]{8}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.regex' => __('mobile number must be saudi number')
        ];
    }
}
