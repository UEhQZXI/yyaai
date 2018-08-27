<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'app_users';
    public $primaryKey = 'id';
    public $timestamps = FALSE;

    /**
     * 关联案例表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Article()
    {
        return $this->hasMany('App\Models\Article','user_id');
    }

    /**
     * 关联咨询表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Advisory()
    {
        return $this->hasMany('App\Models\Advisory','user_id');
    }

    /**
     * 关联案例评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ArticleComment()
    {
        return $this->hasMany('App\Models\ArticleComment','user_id');
    }

    /**
     * 关联案例子评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ArticleChildComment()
    {
        return $this->hasMany('App\Models\ArticleChildComment','user_id');
    }

    /**
     * 关联咨询评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AdvisoryComment()
    {
        return $this->hasMany('App\Models\AdvisoryComment','user_id');
    }

    /**
     * 关联咨询子评论表
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AdvisoryChildComment()
    {
        return $this->hasMany('App\Models\AdvisoryChildComment','user_id');
    }
}
