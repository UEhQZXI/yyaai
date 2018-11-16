<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlePageview extends Model
{
    protected $table = 'app_article_pageviews';
    public $timestamps = FALSE;
    protected $fillable = ['article_id', 'user_ip'];
}
