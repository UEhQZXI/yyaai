<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvisoryComment extends Model
{
    public $table = 'app_advisory_comments';
    public $primaryKey = 'id';
    public $timestamps = FALSE;

    /**
     * 关联用户表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * 关联咨询表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advisory()
    {
        return $this->belongsTo('App\Models\Advisory','advisory_id');
    }

    /**
     * 关联子评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advisoryChildComment()
    {
        return $this->belongsTo('App\Models\AdvisoryChildComment','advisory_comment_id');
    }
}
