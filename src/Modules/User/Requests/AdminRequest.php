<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Models\User;

class AdminRequest extends FormRequest
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
            'name' => 'required',
            'role_id' => 'required',
            'mobile' => 'required|unique:users,mobile,' . request()->url('id'),
            'email' => 'nullable|sometimes|email|unique:users,email,' . request()->url('id'),
            'password' => 'nullable|sometimes|min:6',
        ];
    }
}
