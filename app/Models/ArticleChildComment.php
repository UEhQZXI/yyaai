<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ArticleComment;

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
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * 关联案例父评论表
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function articleComment()
    {
        return $this->belongsTo('App\Models\ArticleComment','article_comment_id');
    }

    public function getCreateTimeAttribute($value)
    {
        return date('Y-m-d H:i:s', $value);
    }

    public function getReplyIdAttribute($value)
    {
        $s = self::find($value);

        if ($s) {
            $user = User::find($s->user_id);
            $arr = ['reply_id' => $value, 'reply_user_id' => $user->id, 'reply_user' => $user->name];
        } else {
            $s = ArticleComment::find($this->article_comment_id);
            $user = User::find($s->user_id);
            $arr = ['reply_id' => $value, 'reply_user_id' => $user->id, 'reply_user' => $user->name];
        }

        return $arr;
    }
}
