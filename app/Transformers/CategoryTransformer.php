<?php
namespace App\Transformers;

use App\Models\ArticleClassify;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(ArticleClassify $classify)
    {
        return [
            'id' => $classify->id,
            'name' => $classify->name,
        ];
    }
}