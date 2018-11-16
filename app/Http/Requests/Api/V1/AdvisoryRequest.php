<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class AdvisoryRequest extends FormRequest
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
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'classify_id' => 'required|exists:app_article_classify,id',
                    'anonymous' => 'int',
                ];
                break;
            case 'PATCH':
                return [
                    'title' => 'string',
                    'content' => 'string',
                    'classify_id' => 'exists:app_article_classify,id',
                    'anonymous' => 'int',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'title' => '标题',
            'title.required' => '标题不能为空',
            'classify_id' => '分类',
            'classify_id.required' => '请选择一个分类',
            'classify_id.exists' => '分类不存在',
            'anonymous' => '匿名',
        ];
    }
}
