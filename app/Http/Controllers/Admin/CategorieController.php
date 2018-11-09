<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;

class CategorieController extends MiddleController
{
    public function view()
    {
    	return view('admin.categorie.index');
    }
}
