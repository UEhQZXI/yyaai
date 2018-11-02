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
            'user_name' => User::select('name')->where('id', $reply->user_id)->first()->name,
            'reply_name' => $reply->reply_id ? User::select('name')->where('id', $reply->reply_id)->first()->name : 0,
            'content' => $reply->content,
            'create_time' => date('Y-m-d H:i:s', $reply->create_time),
        ];
    }
}