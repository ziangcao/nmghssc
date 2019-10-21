<?php

namespace App\Http\Controllers;

use App\Nav;
use App\Http\Controllers\Controller;

class NavController extends Controller
{
    /**
    * 导航展示(主副导航都存在)。
    * 
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
            $data[$key]['image'] = $val['image'] ? env('qiniu_path').$val['image']: null;
            $navs = Nav::where('id',$val['id'])->first();
            if($navs['pid']===0){
                $list_son = Nav::where('pid',$val['id'])->get()->toarray();
                if(!empty($list_son)){
                    $data[$key]['data'] = $list_son;
                }
            }
        }

        return response($data,200);
    }

    /**
    * 导航展示(主副导航都存在)。
    * 
    * @return Response
    */
   
    public function primary()
    {
        $list = Nav::where('pid',0)->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            $data[$key]['image'] = $val['image'] ? env('qiniu_path').$val['image']: null;
        }
        
        return response($data,200);
    }

    /**
    * 导航展示(主副导航都存在)。
    * 
    * @return Response
    */
   
    public function second($pid)
    {
        $list = Nav::where('pid',$pid)->get()->toarray();  
        return response($list,200);
    }
}