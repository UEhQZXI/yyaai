<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\ProductSKU;
use App\Models\BUY;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 测试
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function test()
    {
        $pro = ProductSKU::select('product_id','num_id','znum','price')->get();
   
        foreach ( $pro as $value ) {
           $value['product_id'] = ltrim(str_replace('S','',$value['product_id']),'0');
           $value['znum'] = explode(',',$value['znum'])[2];
        }
        $new = array();
        $arr = [];
        for ($i=0; $i < sizeof($pro); $i++) { 
            if ($pro[$i]['znum'] == '296') {
                array_push($new,$pro[$i]);
                array_push($arr,$pro[$i]['num_id']);
            }
        }
        $arr = array_unique($arr);
        $arr = array_values($arr);
        $a = \DB::table('product_buyamount')->select('price','ps_id')->whereIn('ps_id',$arr)->get();
        foreach ($a as $value) {
            $pri = $value->price / 1.1;
            BUY::where('ps_id', $value->ps_id)
                        ->where('price', $value->price)
                        ->update(['price' => ($pri * 0.16) + $pri]);
        }
        return $a;
    }
}
