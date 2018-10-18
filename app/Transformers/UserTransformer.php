<?php
namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'avatar' => $user->avatar,
            'sex' => $user->sex,
            'birthday' => $user->birthday,
            'address' => $user->address,
            'description' => $user->description,
            'integral' => $user->integral,
            'fans' => $user->fans,
            'create_time' => date('Y-m-d H:i:s', $user->create_time),
        ];
    }
}