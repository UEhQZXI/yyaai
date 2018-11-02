<?php

namespace App\Transformers;

use App\Models\Advisory;
use League\Fractal\TransformerAbstract;

class AdvisoryTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['user', 'articleClassify'];

    public function transform(Advisory $advisory)
    {
        return [
            'id' => $advisory->id,
            'title' => $advisory->title,
            'content' => $advisory->content,
            'user_id' => (int) $advisory->user_id,
            'classify_id' => (int) $advisory->classify_id,
            'anonymous' => (int) $advisory->anonymous,
            'create_time' => time(),
        ];
    }

    public function includeUser(Advisory $advisory)
    {
        return $this->item($advisory->user, new UserTransformer());
    }

    public function includeArticleClassify(Advisory $advisory)
    {
        return $this->item($advisory->articleClassify, new CategoryTransformer());
    }
}