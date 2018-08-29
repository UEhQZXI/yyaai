<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return [
            'id' => $article->id,
            'classify_id' => $article->classify_id,
            'title' => $article->title,
            'content' => $article->content,
            'user_id' => (int) $article->user_id,
            'pageviews' => $article->pageviews ? $article->pageviews : 0,
            'likes' => $article->likes ? $article->likes : 0,
            'create_time' => date('Y-m-d H:i:s', $article->create_time),
            'status' => $article->status,
            'before' => $article->before,
            'after' => $article->after,
        ];
    }
}