<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ArticleClassify;
use App\Models\Store\Categories;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = ArticleClassify::all();

        return $this->response->array(['message' => 'success', 'data' => $categories]);
//        return $this->response->collection(ArticleClassify::all(), new CategoryTransformer());
    }
}
