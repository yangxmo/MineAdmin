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
 * 商品品牌Dto （导入导出）.
 */
#[ExcelData]
class ProductBrandDto implements MineModelExcel
{
    #[ExcelProperty(value: '自增ID', index: 0)]
    public string $id;

    #[ExcelProperty(value: '第三方唯一标识', index: 1)]
    public string $plat_no;

    #[ExcelProperty(value: '唯一编码', index: 2)]
    public string $brand_no;

    #[ExcelProperty(value: '品牌名称', index: 3)]
    public string $name;

    #[ExcelProperty(value: '品牌图片', index: 4)]
    public string $image;

    #[ExcelProperty(value: '品牌状态', index: 5)]
    public string $status;

    #[ExcelProperty(value: '排序', index: 6)]
    public string $sort;

    #[ExcelProperty(value: '创建时间', index: 7)]
    public string $created_at;

    #[ExcelProperty(value: '修改时间', index: 8)]
    public string $updated_at;

    #[ExcelProperty(value: 'deleted_at', index: 9)]
    public string $deleted_at;
}
