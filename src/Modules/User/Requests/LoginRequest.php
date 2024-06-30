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
            'mobile' => 'required|phone:SA|exists:users,mobile,deleted_at,NULL',
        ];
    }
    protected function prepareForValidation()
    {
        $mobile = (string) convert_to_english($this->input('mobile'));
        if($mobile && !str_starts_with($mobile,0)){
            $this->merge([
                'mobile' => '0'.$mobile
            ]);
        }
    }
}
