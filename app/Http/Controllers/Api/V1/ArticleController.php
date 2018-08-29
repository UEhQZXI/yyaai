<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Transformers\ArticleTransformer;
use App\Http\Requests\Api\ArticleRequest;

class ArticleController extends Controller
{
    public function store(ArticleRequest $request, Article $article)
    {
    	$article->fill($request->all());
    	$article->user_id = 21;
    	$article->create_time = $_SERVER['REQUEST_TIME'];
    	$article->save();

    	return $this->response->item($article, new ArticleTransformer())->setStatusCode(201);
    }

    public function destroy(Article $article)
    {
    	$this->authorize('destroy', $article);
    	$article->delete();

    	return $this->response->noContent();
    }

    public function tests(Request $request)
    {
    	echo 'Hello World';
    }
}