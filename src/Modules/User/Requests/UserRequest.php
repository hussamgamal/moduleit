<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

class UserRequest extends FormRequest
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
            'role_id'   =>  'required',
            'name'    =>  'required',
            'email'   =>  'required|email|unique:users,email,' . request()->url('id'),
            'mobile' =>  'nullable|unique:users,mobile,' . request()->url('id'),
            'image' => 'nullable'
        ];
    }
}
