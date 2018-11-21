<?php

namespace App\Http\Requests\Api\V1;

use Dingo\Api\Http\FormRequest;


class AuthorizationRequest extends FormRequest
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
        if ($this->action == 'phoneLogin') {
            return [
                'verification_key' => 'required',
                'verification_code' => 'required'
            ];
        } else {
            return [
                'phone' => 'required',
                'password' => 'string|min:6',
            ];
        }
    }
}
