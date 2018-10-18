<?php

namespace App\Http\Requests\Api\V1\Store;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
                return [
                    'user_name' => 'required|string|min:2',
                    'user_phone' => ['nullable', 'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/'],
                    'user_tel' => 'nullable',
                    'area1' => 'required',
                    'area2' => 'required',
                    'area3' => 'required',
                    'address' => 'required|string'
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'user_name' => '收货人姓名',
            'user_phone' => '收货人手机号码',
            'user_tel' => '收货人电话',
            'area1' => '所属省',
            'area2' => '所属市',
            'area3' => '所属区/县',
            'address' => '详细地址'
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => '收货人姓名不能为空',
            'user_name.string' => '请输入正确的收货人姓名',
            'user_name.min' => '请输入完整的收货人姓名',
            'user_phone.regex' => '手机号码格式不正确',
            'area1.required' => '所属省不能为空',
            'area2.required' => '所属市不能为空',
            'area3.required' => '所属区/县不能为空',
            'address.required' => '请填写详细地址'
        ];
    }
}
