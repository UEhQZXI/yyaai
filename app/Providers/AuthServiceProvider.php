<?php

namespace App\Providers;

use App\Models\Advisory;
use App\Models\AdvisoryComment;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleChildComment;
use App\Models\Store\Address;
use App\Models\Store\Cart;
use App\Policies\AdvisoryPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\ArticleCommentPolicy;
use App\Policies\ArticleChildCommentPolicy;
use App\Policies\CartPolicy;
use App\Policies\AddressPolicy;
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
        ArticleChildComment::class => ArticleChildCommentPolicy::class,
        Cart::class => CartPolicy::class,
        Address::class => AddressPolicy::class,
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
