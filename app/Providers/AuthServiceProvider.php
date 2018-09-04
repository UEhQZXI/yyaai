<?php

namespace App\Providers;

use App\Models\Advisory;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Policies\AdvisoryPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\ArticleCommentPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Advisory::class => AdvisoryPolicy::class,
        Article::class => ArticlePolicy::class,
        ArticleComment::class => ArticleCommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
