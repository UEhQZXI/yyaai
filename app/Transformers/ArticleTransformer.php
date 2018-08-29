<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['articleClassify', 'user'];

    public function transform(Article $article)
    {
            return [
                'id' => $article->id,
                'classify_id' => $article->classify_id,
                'title' => $article->title,
                'content' => $article->content,
                'user_id' => (int) $article->user_id,
                'pageviews' => (int) $article->pageviews ? $article->pageviews : 0,
                'likes' => (int) $article->likes ? $article->likes : 0,
                'create_time' => date('Y-m-d H:i:s', $article->create_time),
                'status' => (int) $article->status ? $article->status : 0,
                'before' => $article->before,
                'after' => $article->after,
            ];
    }

    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }

    public function includeArticleClassify(Article $article)
    {
        return $this->item($article->articleClassify, new CategoryTransformer());
    }
}