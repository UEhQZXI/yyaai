<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AdvisoryRepliesRequest;
use App\Models\Advisory;
use App\Models\AdvisoryComment;
use App\Transformers\AdvisoryReplyTransformer;

class AdvisoryReplyController extends Controller
{
    public function store(AdvisoryRepliesRequest $request, Advisory $advisory, AdvisoryComment $comment)
    {
        $floor = AdvisoryComment::where('advisory_id', $advisory->id)->count() + 1;

        $comment->content = $request->content;
        $comment->advisory_id = $advisory->id;
        $comment->user_id = $this->user()->id;
        $comment->create_time = $_SERVER['REQUEST_TIME'];
        $comment->floor = $floor;
        $comment->save();

        return $this->response->item($comment, new AdvisoryReplyTransformer())
            ->setStatusCode(201);
    }

    public function index(Advisory $advisory)
    {
        $replies = $advisory->advisoryComment()->paginate(20);

        return $this->response->paginator($replies, new AdvisoryReplyTransformer());
    }
}
