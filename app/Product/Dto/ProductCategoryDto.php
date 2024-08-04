<?php

declare(strict_types=1);
/**
 * This file is part of MineAdmin.
 *
 * @link     https://www.mineadmin.com
 * @document https://doc.mineadmin.com
 * @contact  root@imoi.cn
 * @license  https://github.com/mineadmin/MineAdmin/blob/master/LICENSE
 */

namespace App\Product\Dto;

use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;
use Mine\Interfaces\MineModelExcel;

/**
 * 商品分类Dto （导入导出）.
 */
#[ExcelData]
class ProductCategoryDto implements MineModelExcel
{
    #[ExcelProperty(value: 'id', index: 0)]
    public string $id;

    #[ExcelProperty(value: '分类标识', index: 1)]
    public string $category_no;

    #[ExcelProperty(value: '商品', index: 2)]
    public string $plat_no;

    #[ExcelProperty(value: '上级编码', index: 3)]
    public string $parent_no;

    #[ExcelProperty(value: '品牌编码', index: 4)]
    public string $brand_no;

    #[ExcelProperty(value: '分组名称', index: 5)]
    public string $title;

    #[ExcelProperty(value: '分组图片', index: 6)]
    public string $image;

    #[ExcelProperty(value: '商品总数', index: 7)]
    public string $feed_count;

    #[ExcelProperty(value: '分组状态', index: 8)]
    public string $status;

    #[ExcelProperty(value: '分类排序', index: 9)]
    public string $sort;

    #[ExcelProperty(value: '创建时间', index: 10)]
    public string $created_at;

    #[ExcelProperty(value: '修改时间', index: 11)]
    public string $updated_at;

    #[ExcelProperty(value: 'deleted_at', index: 12)]
    public string $deleted_at;
}
