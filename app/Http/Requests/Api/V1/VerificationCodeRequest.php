<?php

namespace App\Http\Requests\Api\V1;

use Dingo\Api\Http\FormRequest;

class VerificationCodeRequest extends FormRequest
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
        switch ($this->action) {
            case 'login':
                return $rule = [
                    'phone' => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/'
                    ]];
                break;
            case 'bindPhone':
                return $rule = [
                    'verification_key' => 'required',
                    'verification_code' => 'required'
                ];
                break;
            default:
                return $rule = [
                    'phone' => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/',
                        'unique:app_users'
                    ]];
                break;

        }
    }

    public function attributes()
    {
        return [
            'phone' => '手机号码',
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => '该手机已注册，可以通过密码或短信快捷登录',
            'phone.regex' => '手机号码格式不正确',
            'phone.required' => '手机号码不能为空'
        ];
    }
}
