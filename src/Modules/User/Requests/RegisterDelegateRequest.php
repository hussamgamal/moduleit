<?php

namespace Modules\User\Requests;

use App\Enum\UserType;
use Illuminate\Foundation\Http\FormRequest;

class RegisterDelegateRequest extends FormRequest
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
            'password' => 'required',
            'lang' => 'required',
            'type' => 'required',
            'name' => 'required|min:1|max:60',
            'mobile' => 'required|phone:SA|unique:users,mobile,NULL,id,deleted_at,NULL|regex:/^05\d{8}$/',
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL|email',
            'mark_id' => 'required|exists:car_types,id,deleted_at,NULL',
            'model_id' => 'required|exists:car_types,id,deleted_at,NULL',
            'model_year' => 'required|numeric|digits:4|integer|min:2010|max:'.(date('Y')),
            'plate_number' => 'required|string|max:10',
            'licence' => 'required|image',
            'car_image' => 'required|image',
            'id_avatar' => 'required|image',
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
                'lang' => request()->header('lang','ar'),
                'type' => UserType::DELEGATE,
            ]);
        }
    }
}
