<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:users,name',
            'mobile' => ['required', 'unique:users,mobile', 'regex:/^05[0-9]{8}$/'],
            'email' => 'nullable|unique:users,email|email'
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.regex' => __('mobile number must be saudi number')
        ];
    }
}
