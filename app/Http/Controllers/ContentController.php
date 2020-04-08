<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Content;

class ContentController extends Controller
{

    public function news(Request $request)
    {
        $list = Content::where('selected',1)
            ->where('nid',1)
            ->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
//                $data[$key]['images'] = env('qiniu_path').current($val['images']);
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }

    public function case(Request $request)
    {
        $list = Content::where('selected',1)
            ->where('nid',3)
            ->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
//                $data[$key]['images'] = env('qiniu_path').current($val['images']);
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }

    public function products(Request $request)
    {
        $list = Content::where('selected',1)
            ->where('nid',$request->nid)
            ->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }

   /**
    *  
    *
    * @param  int  $id
    * @return Response
    */
   
    public function detail($id)
    {   
        $list = Content::where('id',$id)
            ->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }

    public function company()
    {
        $list = Content::where('nid',4)
            ->first();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }


    public function list(Request $request)
    {
        $list = Content::where('selected',1)
            ->where('nid','!=',1)
            ->where('nid','!=',3)
            ->where('nid','!=',2)
            ->where('nid','!=',4)
            ->orderBy('sort','desc')
            ->limit(8)
            ->get()->toarray();
        $data =[];
        foreach($list as $key =>$val){
            foreach($val as $k =>$v){
                $data[$key][$k] = $v;
            }
            if(!empty($val['images'])){
//                $data[$key]['images'] = env('qiniu_path').current($val['images']);
                foreach($val['images'] as $k1 => &$v1){
                    $data[$key]['images'][$k1] = env('qiniu_path').$v1;
                }
            }
        }
        return response($data,200);
    }
}
