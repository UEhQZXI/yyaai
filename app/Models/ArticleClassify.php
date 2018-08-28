<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleClassify extends Model
{
    public $table = 'app_article_classify';
    public $primaryKey = 'id';
    public $timestamps = FALSE;

    /**
     * 关联案例表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Article()
    {
        return $this->hasMany('App\Models\Article','classify_id');
    }

    /**
     * 关联咨询表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Advisory()
    {
        return $this->hasMany('App\Models\Advisory','classify_id');
    }
}
