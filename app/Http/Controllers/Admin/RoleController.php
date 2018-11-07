<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;

class RoleController extends Controller
{
    public function indexview()
    {
    	$data = Admin::all();
    	$data0 = $data1 = $data2 = array(0);

    	foreach ($data as $val) {
    		if ($val->role == 0) {
    			$data0[0] += 1;
    			$data0[] = $val;
    		} else if ($val->role == 1) {
    			$data1[0] += 1;
    			$data1[] = $val;
    		} else {
    			$data2[0] += 1;
    			$data2[] = $val;
    		}
    	}

    	return view('admin.role.index')->with(
    		[
    			'data0' => $data0,
    			'data1' => $data1,
    			'data2' => $data2
    		]
    	);
    }
}
