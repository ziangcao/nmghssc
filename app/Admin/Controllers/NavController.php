<?php

namespace App\Admin\Controllers;

use App\Nav;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class NavController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '导航';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Nav);

        $grid->column('id', __('Id'));
        $grid->column('name', __('名称'));
        $grid->column('image', __('图标'))->image('',30,30);
        $grid->column('pid', __('父级栏目'))->display(function($pid){
            if($pid!=0){
                $nav_name = Nav::where('id',$pid)->first();
                return $nav_name->name;
            }else{
                return '根栏目';
            }   
        });
        $grid->column('sort', __('排序'));
        $grid->column('explain', __('解释'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Nav::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('pid', __('父级栏目'))->as(function($pid){
            if($pid!=0){
                $nav_name = Nav::where('id',$pid)->first();
                return $nav_name->name;
            }else{
                return '根栏目';
            }
            
        });;
        $show->field('name', __('名称'));
        $show->field('image', __('图标'))->image();
        $show->field('sort', __('排序'));
        $show->field('explain', __('Explain'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Nav);
        // $form->number('pid', __('Pid'));
        $form->select('pid','父级栏目')->options(function ($pid){
            $navs = Nav::where('pid',0)->get();
            $res = [0=>'根栏目'];
            foreach($navs as $val){
                $res[$val->id] = $val->name;
            }
            return $res;
        });
        $form->text('name', __('Name'));
        $form->image('image', '图片')->help('请上传图片格式')->removable();
        $form->number('sort', __('sort'));
        $form->text('explain', __('Explain'));

        return $form;
    }

}
