<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Api\V1\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }
}
