<?php

namespace App\Transformers;

use App\Models\AdvisoryComment;
use League\Fractal\TransformerAbstract;

class AdvisoryReplyTransformer extends TransformerAbstract
{
    public function transform(AdvisoryComment $reply)
    {
        return [
            'id' => $reply->id,
            'user_id' => (int) $reply->user_id,
            'advisory_id' => (int) $reply->advisory_id,
            'content' => $reply->content,
            'create_time' => date('Y-m-d H:i:s', $reply->create_time),
        ];
    }
}