<?php

namespace App\Admin\Controllers;

use App\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner图';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner);
//        $grid->picture()->gallery(['width' => 50, 'height' => 50]);
        $grid->column('id', __('编码Id'))->width(100);
        $grid->column('img_path', '图片路径')->display(function ($pictures) {
            return $pictures;
        })->image('', 50, 50);;
        $grid->column('title', '标题')->width(150);
        $grid->column('describe', '描述')->display(function ($describe) {
            $describe = mb_strlen($describe)< 200 ? $describe : mb_substr($describe,0,200).'...';
            return $describe;
        });
        $grid->column('is_delete', '是否禁用')->display(function ($is_delete) {
            return $is_delete ? '是' : '否';
        })->width(100);
        $grid->column('selected', '前台展示')->display(function ($selected) {
            return $selected ? '是' : '否';
        })->width(100);
        $grid->column('created_at', '创建时间')->width(100);
        $grid->column('updated_at', '更新时间')->width(100);

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('编码id'));
        $show->field('title', __('标题'));
        $show->field('img_path', __('图片显示'))->image();
        $show->field('describe', __('描述'));
        $show->field('is_delete', __('是否禁用'))->using(['1' => '是', '0' => '否']);;
        $show->field('selected', __('前台显示'))->using(['1' => '是', '0' => '否']);
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
        $form = new Form(new Banner);
        $form->text('title', __('标题'));
        $form->multipleImage('img_path', '图片')->help('请上传图片格式')->sortable()->removable();
        $form->UEditor('describe');
        $states = [
            'on'  => ['value' => 1, 'text' => '打开', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger'],
        ];
        $form->switch('selected')->states($states);
        $form->switch('is_delete')->states($states);

        return $form;
    }
}
