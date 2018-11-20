<?php

namespace App\Http\Requests\Api\V1;

use Dingo\Api\Http\FormRequest;

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
        switch ($this->method()) {
            case 'POST':
                if ($this->action == 'bindPhone') {
                    return [
                        'verification_key' => 'required|string',
                        'verification_code' => 'required|string',
                    ];
                }
                return [
                    'password' => 'required|string|min:6',
                    'verification_key' => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|between:2,10|regex:/^[A-Za-z0-9\-\_]+$/',
                    'avatar' => 'string'
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key' => '短信验证码 key',
            'verification_code' => '短信验证码',
        ];
    }

    public function messages()
    {
        return [
            'name.regex' => '用户名只支持英文、数字、横杆和下划线',
            'name.between' => '用户名必须介于 2 - 10 个字符之间',
            'name.required' => '用户名不能为空'
        ];
    }
}
