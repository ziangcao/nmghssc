<?php

namespace App\Admin\Controllers;

use App\Content;
use App\Nav;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '内容展示';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Content);

        $grid->column('id', __('Id'));
        $grid->column('nid', __('所属类目'))->display(function($nid){
            if($nid!=0){
                $nav_name = Nav::where('id',$nid)->first();
                return $nav_name->name;
            }else{
                return '根栏目';
            }   
        });
        $grid->column('title', __('标题'));
        $grid->column('content', __('内容'))->display(function ($describe) {
            $describe = strip_tags($describe);
            $describe = mb_strlen($describe) < 100 ? $describe : mb_substr($describe,0,100).'...';
            return $describe;
        });
        $grid->column('images', __('图集'))->display(function ($pictures) {
            return $pictures;
        })->image('', 50, 50);
        $grid->column('author', __('发布者'));
        // $grid->column('sort', __('Sort'));
        $grid->column('selected', __('前台展示'))->display(function ($selected) {
            return $selected ? '是' : '否';
        })->width(100);
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('U更新时间'));

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
        $show = new Show(Content::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('nid', __('所属类目'))->display(function($nid){
            if($nid!=0){
                $nav_name = Nav::where('id',$nid)->first();
                return $nav_name->name;
            }else{
                return '根栏目';
            }   
        });
        $show->field('title', __('标题'));
        $show->field('content', __('内容'));
        $show->field('author', __('发布者'));
        // $show->field('sort', __('Sort'));
        $show->field('images', __('图集'))->image();
        $show->field('selected', __('前台展示'))->using(['1' => '是', '0' => '否']);
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
        $form = new Form(new Content);

        $form->select('nid', __('所属类目'))->options(function (){
            $navs = Nav::get();
            $res = [];
            foreach($navs as $val){
                $res[$val->id] = $val->name;
            }
            return $res;
        })->required();
        $form->text('title', __('标题'));
        $form->UEditor('content', __('内容'))->required();
        $form->multipleImage('images', '图片')->help('请上传图片格式')->sortable()->removable();
        $form->text('author', __('发布者'))->default(env('company_name'));
        // $form->number('sort', __('Sort'));
        $states = [
            'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
        ];
        $form->switch('selected','前台展示')->states($states)->default(1);

        return $form;
    }
}
