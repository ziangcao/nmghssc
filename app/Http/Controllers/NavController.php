<?php

namespace App\Http\Controllers;

use App\Nav;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    /**
     * 导航展示。
     *
     * @param  int  $id
     * @return Response
     */
    public function index()
    {
        $list = Nav::where('pid',0)->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            $data[$key]['image'] = env('img_path').$val['image'];
        }
        // return $nav_list;
        return response($data,200);
    }
}