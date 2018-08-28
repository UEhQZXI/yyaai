<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisoryChildComment extends Model
{
    public $table = 'app_advisory_childs_comments';
    public $primaryKey = 'id';
    public $timestamps = FALSE;

    /**
     * 关联用户表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * 关联父评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function AdvisoryComment()
    {
        return $this->belongsTo('App\Models\AdvisoryComment','advisory_comment_id');
    }
}
