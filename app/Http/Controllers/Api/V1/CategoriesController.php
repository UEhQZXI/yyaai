<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ArticleClassify;
use App\Transformers\CategoryTransformer;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return $this->response->collection(ArticleClassify::all(), new CategoryTransformer());
    }
}
