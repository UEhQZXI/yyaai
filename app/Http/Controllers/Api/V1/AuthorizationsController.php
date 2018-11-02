<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    public function store(AuthorizationRequest $request)
    {
        $loginInfo['phone'] = $request->phone;
        $loginInfo['password'] = $request->password;

        if (!$token = \Auth::guard('api')->attempt($loginInfo)) {
            return $this->response->errorUnauthorized('账号或密码错误');
        }

        return $this->response->array(['message' => 'success','data' => [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 50000
        ]]);
    }
}