<?php

namespace App\Transformers;

use App\Models\ArticleChildComment;
use League\Fractal\TransformerAbstract;

class ArticleChildCommentTransformer extends TransformerAbstract
{
    public function transform(ArticleChildComment $articleChildComment)
    {
        return [
            'id' => $articleChildComment->id,
            'user_id' => (int) $articleChildComment->user_id,
            'article_comment_id' => (int) $articleChildComment->article_comment_id,
            'content' => $articleChildComment->content,
            'create_time' => date('Y-m-d H:i:s', $articleChildComment->create_time),
            'reply_id' => $articleChildComment->reply_id,
        ];
    }
}