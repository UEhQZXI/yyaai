<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ArticleCommentRequest;
use App\Models\ArticleComment;
use App\Models\Article;
use App\Models\User;
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

        //今日评论量
        $today_article_comments = ArticleComment::where('user_id', $this->user()->id)
                                   ->where('create_time', '>=', strtotime(date('Ymd')))
                                   ->count();
        //今日评论数量小于6条，增加2积分
        if ($today_article_comments <= 5)
            User::where('id', $this->user()->id)->increment('integral', 2);

    	return $this->response->array(['message' => '评论成功', 'data' => []]);
    }

    public function destroy(ArticleComment $articleComment)
    {
    	$this->authorize('destroy', $articleComment);
    	$articleComment->delete();

    	return $this->response->array(['message' => '删除成功', 'data' => []]);
    }

    public function index(Article $article)
    {
        $data = $article->articleComment()->paginate(10);
        
        return $this->response->array(['message' => 'success', 'data' => $data]);
    }
}