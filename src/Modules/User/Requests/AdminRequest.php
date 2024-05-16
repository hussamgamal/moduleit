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
        $rules = [
            'role_id'   =>  'required',
            'name'    =>  'required',
            'email'   =>  'required|email|unique:users,email,' . request()->route('moderator'),
            'mobile' =>  'nullable|unique:users,mobile,' . request()->route('moderator'),
            'image' => 'nullable'
        ];
        if (!request()->route('moderator')) {
            $rules['password'] = 'required';
        }
        return $rules;
    }
}
