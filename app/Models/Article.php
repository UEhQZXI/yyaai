<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'app_articles';
    public $primaryKey = 'id';
    public $timestamps = FALSE;
    protected $fillable = ['title', 'content', 'classify_id', 'before', 'after', 'hospital', 'project', 'price'];

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
     * 关联案例评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articleComment()
    {
        return $this->hasMany('App\Models\ArticleComment','article_id');
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
