<?php

namespace App\Http\Requests\Api\V1;

use Dingo\Api\Http\FormRequest;
use Auth;
class ArticleRequest extends FormRequest
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
                    'classify_id' => 'required|int',
                    'title' => 'required|string',
                    'content' => 'required|string',
                    'before' => 'required|string',
                    'after' => 'required|string',
                    'hospital' => 'string',
                    'project' => 'string',
                    'price' => '',
                ];
                break;
            case 'PATCH':
                return [
                    'classify_id' => 'int',
                    'title' => 'string',
                    'content' => 'string',
                    'before' => 'string',
                    'after' => 'string',
                    'hospital' => 'string',
                    'project' => 'string',
                    'price' => '',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'classify_id' => '分类',
            'title' => '标题',
            'content' => '内容',
            'before' => '矫正前照片',
            'after' => '矫正后照片',
            'hospital' => '做牙医院',
            'project' => '做的项目',
            'price' => '',
        ];
    }
}
