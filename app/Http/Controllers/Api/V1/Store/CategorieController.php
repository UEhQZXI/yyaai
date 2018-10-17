<?php

namespace App\Http\Controllers\Api\V1\Store;

use Illuminate\Http\Request;
use App\Http\Requests\Api\V1\Store\CategorieRequest;
use App\Models\Store\Categories;
use App\Transformers\Store\CategorieTransformer;
use App\Http\Controllers\Api\V1\Controller;
use App\Common\Res;

class CategorieController extends Controller
{
    public function store (CategorieRequest $request, Categories $categories) 
    {
    	$categories->fill($request->all());
    	$categories->save();

    	return $this->response->noContent();
    }

    public function update(CategorieRequest $request, $categorie_id)
    {
    	$categorie = Categories::find($categorie_id);
    	$categorie->update($request->all());

    	return $this->response->noContent();
    }

     public function destroy($categorie_id)
     {
     	if (Categories::where('pid', $categorie_id)->count() > 0)
     		return $this->response->item('删除失败，有子分类');

     	Categories::where('id', $categorie_id)->delete();

     	return $this->response->noContent('删除成功');
     }

     public function index(Request $request)
     {
     	$query = Categories::query();

     	$request->has('pid')
     						? $query->where('pid', $request->pid)
     						: $query->where('pid', 0);
     	$data = $query->get();
     	return $this->response->array($data);
     }
}
