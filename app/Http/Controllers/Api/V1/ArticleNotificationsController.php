<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Transformers\ArticleNotificationTransformer;

class ArticleNotificationsController extends Controller
{
    public function index()
    {
    	$notifications = $this->user->notifications()->paginate(10);

    	return $this->response->paginator($notifications, new ArticleNotificationTransformer());
    }
}
