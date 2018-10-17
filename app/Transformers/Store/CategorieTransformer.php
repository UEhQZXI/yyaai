<?php

namespace App\Transformers\Store;

use League\Fractal\TransformerAbstract;
use App\Models\Store\Categories;

class CategorieTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['articleClassify', 'user'];

    public function transform(Categories $categorie)
    {
            return [
               'id' => $categorie->id,
               'name' => $categorie->name,
               'pid' => $categorie->pid,
            ];
    }

    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }

    public function includeArticleClassify(Article $article)
    {
        return $this->item($article->articleClassify, new CategoryTransformer());
    }
}