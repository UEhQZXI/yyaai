<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ArticleComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticleCommentPolicy
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

    public function destroy(User $user, ArticleComment $articleComment)
    {
        return $user->isAuthorOf($articleComment) || $user->isAuthorOf($articleComment->article);
    }
}
