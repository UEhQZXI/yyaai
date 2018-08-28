<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisory extends Model
{
    public $table = 'app_advisory';
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
     * 关联咨询评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function advisoryComment()
    {
        return $this->hasMany('App\Models\AdvisoryComment','advisory_id');
    }

    /**
     * 关联分类表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articleClassify()
    {
        return $this->belongsTo('App\Models\ArticleClassify','classify_id');
    }
}
