<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleChildComment extends Model
{
    public $table = 'app_article_childs_comments';
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
     * 关联案例父评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ArticleComment()
    {
        return $this->belongsTo('App\Models\ArticleComment','article_comment_id');
    }
}
