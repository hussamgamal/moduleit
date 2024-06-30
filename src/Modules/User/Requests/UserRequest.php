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
            'name' => 'required|min:1|max:60',
            'image' => 'required|image',
            'mobile' => 'required|unique:users,mobile,' . $this->route('user').',id,deleted_at,NULL|regex:/^05\d{8}$/',
            'email' => 'required|email|unique:users,email,' . $this->route('user').',id,deleted_at,NULL|email',
            'password' => 'required',
        ];
    }
    protected function prepareForValidation()
    {
        $mobile = (string) convert_to_english($this->input('mobile'));
        if($mobile){
            if(!str_starts_with($mobile,0)){
                $mobile = '0'.$mobile;
            }
            $this->merge([
                'mobile' => $mobile,
                'password' => 'P@ssw0rd',
            ]);
        }
    }
}
