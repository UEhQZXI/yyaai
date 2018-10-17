<?php

namespace App\Http\Requests\Api\V1\Store;

use Illuminate\Foundation\Http\FormRequest;

class CategorieRequest extends FormRequest
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
        if ($this->method() == 'POST') {
            return [
                'name' => 'required|string',
                'pid' => 'required|int',
            ];
        } else if ($this->method() == 'PATCH') {
            return [
                'name' => 'string',
                'pid' => 'int',
            ];
        }
    }

    public function messages ()
    {
        return [
            'name.required' => '请输入分类名',
            'name.string' => '分类名格式错误',
            'pid.required' => '缺少父分类id',
            'pid.int' => '父分类id类型错误',
        ];
    }
}
