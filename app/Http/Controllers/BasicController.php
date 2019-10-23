<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Basic;

class BasicController extends Controller
{
    /**
     * 基础信息获取
     *
     * @return Response
     */
    public function index()
    {
        $list = Basic::get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
        	foreach($val as $k =>$v){
        		$data[$key][$k] = $v;
        	}
        	$data[$key]['logo'] = env('qiniu_path').current($val['logo']);
        }
        return response($data,200);
    }
}
