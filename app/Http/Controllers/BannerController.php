<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    /**
     * banner展示
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $list = Banner::where('is_delete',0)
        	->where('selected',1)
        	->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
        	foreach($val as $k =>$v){
        		$data[$key][$k] = $v;
        	}
        	$data[$key]['img_path'] = env('img_path').current($val['img_path']);
        }
        return response($data,200);
    }
}
