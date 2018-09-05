<?php

namespace App\Transformers;

use App\Models\ArticleComment;
use League\Fractal\TransformerAbstract;

class ArticleCommentTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'articleChildComment'];

    public function transform(ArticleComment $articleComment)
    {
        return [
            'id' => $articleComment->id,
            'user_id' => (int) $articleComment->user_id,
            'article_id' => (int) $articleComment->article_id,
            'content' => $articleComment->content,
            'create_time' => date('Y-m-d H:i:s', $articleComment->create_time),
        ];
    }

    public function includeUser(ArticleComment $articleComment)
    {
        return $this->item($articleComment->user, new UserTransformer());
    }

    public function includeArticleChildComment(ArticleComment $articleComment)
    {
        return $this->item($articleComment->articleChildComment, new ArticleChildCommentTransformer());
    }
}