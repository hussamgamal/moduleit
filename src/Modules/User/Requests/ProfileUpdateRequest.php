<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'new_mobile' => 'nullable|phone:SA|unique:users,mobile,'.auth()->id().',id,deleted_at,NULL|regex:/^05\d{8}$/',
            'email' => 'required|unique:users,email,'.auth()->id().',id,deleted_at,NULL|email',
        ];
    }
    protected function prepareForValidation()
    {
        $mobile = (string) convert_to_english($this->input('mobile'));
        if($mobile){
            if('0'.$mobile != auth()->user()->mobile){
                $new_mobile = !str_starts_with($mobile,0) ? '0'.$mobile : $mobile;
            }
            $this->merge([
                'new_mobile' => @$new_mobile,
                'password' => 'P@ssw0rd',
                'lang' => request()->header('lang','ar'),
            ]);
        }
    }
}
