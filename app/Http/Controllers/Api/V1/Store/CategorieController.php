<?php

namespace App\Http\Controllers\Api\V1\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Store\ArticleRequest;
use App\Models\Store\Categories;

class CategorieController extends Controller
{
    public function store (CategorieRequest $request, Categories $categories) 
    {
    	$categories->fill($request->all());
    	echo 12312312;
    	// $categories->save();

    	return $this->response->array(['添加成功']);
    }
}
