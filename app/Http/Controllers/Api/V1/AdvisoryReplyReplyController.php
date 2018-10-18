<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AdvisoryReplyReplyRequest;
use App\Models\AdvisoryChildComment;
use App\Models\AdvisoryComment;
use App\Models\User;
use App\Transformers\AdvisoryReplyReplyTransformer;

class AdvisoryReplyReplyController extends Controller
{
    public function store(AdvisoryReplyReplyRequest $request, AdvisoryComment $replies, AdvisoryChildComment $childReplies)
    {
        $childReplies->content = $request->content;
        $childReplies->user_id = $this->user()->id;
        $childReplies->advisory_comment_id = $replies->id;
        $childReplies->reply_id = $childReplies->id ?? 0;
        $childReplies->create_time = $_SERVER['REQUEST_TIME'];
        $childReplies->save();

        // return $this->response->item($childReplies, new AdvisoryReplyReplyTransformer())
        //     ->setStatusCode(201);
        return $this->response->array(['message' => 'success', 'data' => []]);
    }
}
