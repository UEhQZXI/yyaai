<?php

namespace App\Transformers;

use App\Models\Advisory;
use League\Fractal\TransformerAbstract;

class AdvisoryTransformer extends TransformerAbstract
{
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
}