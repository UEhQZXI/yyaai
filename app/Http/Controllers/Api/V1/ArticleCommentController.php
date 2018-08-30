<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ArticleCommentRequest;
use App\Models\ArticleComment;
use App\Models\Article;
use App\Transformers\ArticleCommentTransformer;

class ArticleCommentController extends Controller
{
    public function store(ArticleCommentRequest $request, ArticleComment $articleComment, Article $article)
    {
    	$floor = ArticleComment::where('article_id', $article->id)->count() + 1;

    	$articleComment->content = $request->content;
    	$articleComment->article_id = $article->id;
    	$articleComment->user_id = $this->user()->id;
    	$articleComment->create_time = $_SERVER['REQUEST_TIME'];
    	$articleComment->floor = $floor;
    	$articleComment->save();

    	return $this->response->item($articleComment, new ArticleCommentTransformer())->setStatusCode(201);
    }

    public function destroy(Article $article, ArticleComment $articleComment)
    {
    	$this->authorize('destroy', $articleComment);
    	$articleComment->delete();

    	return $this->response->noContent();
    }
}