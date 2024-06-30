<?php

namespace Modules\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckMobileOtpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => 'required|digits:5',
            'mobile' => 'required|phone:SA|exists:users,mobile,deleted_at,NULL',
            'uuid' => 'required|uuid',
            'device_token' => 'required',
            'device_type' => 'required|string',
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
