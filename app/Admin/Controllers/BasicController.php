<?php

namespace App\Admin\Controllers;

use App\Basic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BasicController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Basic';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Basic);

        $grid->column('id', __('Id'));
        $grid->column('keywords', __('关键词'))->width(80);
        $grid->column('description', __('描述介绍'))->width(100);
        $grid->column('logo', __('Logo'))->display(function ($pictures) {
            return $pictures;
        })->image('', 50, 50);
        // $grid->column('contact', __('联系方式'));
        $grid->column('contact','联系方式')->table()->width(600);
        $grid->column('beian', __('备案'));
        $grid->column('created_at', __('创建时间'))->width(100);
        $grid->column('updated_at', __('更新时间'))->width(100);
        $grid->actions(function ($actions) {
            // 去掉查看
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Basic);

        $form->tags('keywords','关键词');
        $form->textarea('description', __('描述'));
        $form->multipleImage('logo', 'logo')->help('请上传图片格式')->sortable()->removable();
        $form->table('contact','联系方式', function ($table) {
            $table->text('key');
            $table->text('value');
        });
        $form->text('beian', __('备案地址'));

        return $form;
    }
}
