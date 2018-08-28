<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 测试
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function test()
    {
        // 获取全部案例信息并统计它们下面评论的数量
//        $Articles = Article::withCount('ArticleComment')->get();

        // 获取id为1的案例信息并统计它下面评论的数量
        $Articles = User::with('Article.ArticleComment.ArticleChildComment')->get();
        return $Articles;
    }
}
