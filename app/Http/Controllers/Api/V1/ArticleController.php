<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use App\Http\Requests\Api\V1\ArticleRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ArticlePageview;
use App\Models\ArticleChildComment;
use App\Models\ArticleComment;

class ArticleController extends Controller
{
    public function store(ArticleRequest $request, Article $article)
    {
    	$article->fill($request->all());
    	$article->user_id = $this->user()->id;
    	$article->create_time = $_SERVER['REQUEST_TIME'];
    	$article->save();

        //今日发帖的条数
        $today_articles = Article::where('user_id', $this->user()->id)
                                   ->where('create_time', '>=', strtotime(date('Ymd')))
                                   ->count();
        //若发帖少于5条，则增加5点积分                            
        if ($today_articles <= 5)
            User::where('id', $this->user()->id)->increment('integral', 5);

    	return $this->response->array(['message' => '分享成功', 'data' => []]);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
        $article->update($request->all());

        return $this->response->array(['message' => '修改成功', 'data' => []]);
    }

    public function destroy(Article $article)
    {
    	$this->authorize('destroy', $article);
        $article_id = $article->id;
        $article->delete();
        //删除文章的时候，将文章下的评论以及子评论一起删除
        ArticleComment::where('article_id', $article_id)->delete();
        ArticleChildComment::where('article_id', $article_id)->delete();

    	return $this->response->array(['message' => '删除成功', 'data' => []]);
    }

    public function index(Request $request, Article $article)
    {
        $query = $article->query();

        if ($classify_id = $request->classify_id)
            $query->where('classify_id', $classify_id);

        if ($user_id = $request->user_id)
            $query->where('user_id', $user_id);

        switch ($request->order) {
            case 'time':
                $query->orderBy('create_time', 'desc');
                break;

            case 'pageviews':
                $query->orderBy('pageviews', 'desc');
                break;

            case 'likes':
                $query->orderBy('likes', 'desc');
                break;

            default:
                // 
                break;
        }

        $articles = $query->with(['user', 'articleClassify'])->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $articles]);
    }

    public function userIndex()
    {
        $articles =  Article::where('user_id', $this->user()->id)->with(['articleClassify'])->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $articles]);
    }

    public function show(Article $article)
    {
        //获取客户端IP
        $ip = $_SERVER['REMOTE_ADDR'];
        //判断该IP是否访问过该帖子
        $isPageview = ArticlePageview::firstOrNew(['article_id' => $article->id, 'user_ip'=> $ip],
                                                  ['article_id' => $article->id, 'user_ip'=> $ip]);
        //没有访问过 -> 帖子访问量加一
        if (!$isPageview->id) {
            $article->pageviews = $article->pageviews + 1;
            $article->save();
            $isPageview->save();
        }
        
        return $this->response->array(['message' => 'success', 'data' => $article]);
    }
}