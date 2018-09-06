<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ArticleChildCommentRequest;
use App\Models\ArticleComment;
use App\Models\Article;
use App\Models\ArticleChildComment;
use App\Transformers\ArticleChildCommentTransformer;
use App\Models\User;

class ArticleChildCommentController extends Controller
{
    public function store(ArticleChildCommentRequest $request, ArticleComment $articleComment, ArticleChildComment $articleChildComments)
    {
        $articleChildComment = new ArticleChildComment;
        $articleChildComment->user_id = $this->user()->id;
        $articleChildComment->article_comment_id = $articleComment->id;
        $articleChildComment->create_time = $_SERVER['REQUEST_TIME'];
        $articleChildComment->content = $request->content;
        $articleChildComment->reply_id = $articleChildComments->id ?? 0;
        $articleChildComment->save();

    	return $this->response->item($articleChildComment, new ArticleChildCommentTransformer())->setStatusCode(201);
    }

    public function destroy(ArticleChildComment $articleChildComment)
    {
        $this->authorize('destroy', $articleChildComment);
        $articleChildComment->delete();

        return $this->response->noContent();
    }
}