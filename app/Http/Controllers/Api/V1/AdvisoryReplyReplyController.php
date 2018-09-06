<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AdvisoryReplyReplyRequest;
use App\Models\AdvisoryChildComment;
use App\Models\AdvisoryComment;
use App\Models\User;
use App\Transformers\AdvisoryReplyReplyTransformer;

class AdvisoryReplyReplyController extends Controller
{
    public function store(AdvisoryReplyReplyRequest $request, AdvisoryComment $advisory, AdvisoryChildComment $comment)
    {
        $comment->content = $request->content;
        $comment->user_id = $this->user()->id;
        $comment->advisory_comment_id = $advisory->id;
        $comment->reply_id = User::select('id')->where('id', $advisory->id)->first()->id;
        $comment->create_time = $_SERVER['REQUEST_TIME'];
        $comment->save();

        return $this->response->item($comment, new AdvisoryReplyReplyTransformer())
            ->setStatusCode(201);
    }
}
