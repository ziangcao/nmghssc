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
                $data[$key]['images'] = env('qiniu_path').current($val['images']);
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
            $data[$key]['images'] = env('qiniu_path').current($val['images']);
        }
        return response($data,200);
    }
}
