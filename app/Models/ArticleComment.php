<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    public $table = 'app_article_comments';
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
     * 关联案例表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Article()
    {
        return $this->belongsTo('App\Models\Article','article_id');
    }

    /**
     * 关联子评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ArticleChildComment()
    {
        return $this->hasMany('App\Models\ArticleChildComment','article_comment_id');
    }
}
