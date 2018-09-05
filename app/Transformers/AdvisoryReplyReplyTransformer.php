<?php

namespace App\Transformers;

use App\Models\AdvisoryChildComment;
use App\Models\AdvisoryComment;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class AdvisoryReplyReplyTransformer extends TransformerAbstract
{
    public function transform(AdvisoryChildComment $reply)
    {
        return [
            'id' => $reply->id,
            'user_id' => (int) $reply->user_id,
            'parent_comment_id' => (int) $reply->advisory_comment_id,
            'content' => $reply->content,
            'create_time' => date('Y-m-d H:i:s', $reply->create_time),
            'to_user' => $reply->reply_id,
        ];
    }
}