<?php

namespace App\Transformers;

use App\Http\Serializers\NoDataArraySerializer;
use App\Models\AdvisoryChildComment;
use App\Models\AdvisoryComment;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\TransformerAbstract;

class AdvisoryReplyTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','advisoryChildComment'];

    public function transform(AdvisoryComment $reply)
    {
        return [
            'id' => $reply->id,
            'user_id' => (int) $reply->user_id,
            'advisory_id' => (int) $reply->advisory_id,
            'content' => $reply->content,
            'floor' => $reply->floor,
            'create_time' => date('Y-m-d H:i:s', $reply->create_time),
        ];
    }

    public function includeUser(AdvisoryComment $reply)
    {
        return $this->item($reply->user, new UserTransformer());
    }

    public function includeAdvisoryChildComment(AdvisoryComment $reply)
    {
        return $this->collection($reply->advisoryChildComment, new AdvisoryReplyReplyTransformer());
    }
}