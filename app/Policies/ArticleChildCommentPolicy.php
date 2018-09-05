<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ArticleComment;
use App\Models\ArticleChildComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleChildCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, ArticleChildComment $articleChildComment)
    {
        return $user->isAuthorOf($articleChildComment) || $user->isAuthorOf($articleChildComment->articleComment->article);
    }
}
