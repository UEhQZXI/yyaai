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
        //评论的是他父亲还是同辈的（评论同辈为 0 ）
        $articleChildComment->reply_id = $articleChildComments->id ?? 0;
        $articleChildComment->save();

        //今日评论量
        $today_article_child_comments = ArticleChildComment::where('user_id', $this->user()->id)
                                   ->where('create_time', '>=', strtotime(date('Ymd')))
                                   ->count();
        //子评论发帖数量小于6 增加2点积分
        if ($today_article_child_comments <= 5)
            User::where('id', $this->user()->id)->increment('integral', 2);

    	return $this->response->item($articleChildComment, new ArticleChildCommentTransformer())->setStatusCode(201);
    }

    public function destroy(ArticleChildComment $articleChildComment)
    {
        $this->authorize('destroy', $articleChildComment);
        $articleChildComment->delete();

        return $this->response->noContent();
    }
}