<?php

namespace App\Http\Controllers\Api\V1\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class QQController extends Controller
{

    public function index()
    {
        return Socialite::with('qq')->redirect();
    }

    public function notify()
    {
        $user = Socialite::driver('qq')->user();
        dd($user);
    }
}
