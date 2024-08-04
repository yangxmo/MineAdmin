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
 * 商品列表Dto （导入导出）.
 */
#[ExcelData]
class ProductInfoDto implements MineModelExcel
{
    #[ExcelProperty(value: '商品自增ID', index: 0)]
    public string $id;

    #[ExcelProperty(value: '商品标识', index: 1)]
    public string $product_no;

    #[ExcelProperty(value: '三方标识', index: 2)]
    public string $product_plat_no;

    #[ExcelProperty(value: '商品名称', index: 3)]
    public string $name;

    #[ExcelProperty(value: '商品建议销售价', index: 4)]
    public string $price;

    #[ExcelProperty(value: '商品市场价', index: 5)]
    public string $market_price;

    #[ExcelProperty(value: '商品库存', index: 6)]
    public string $sale;

    #[ExcelProperty(value: '商品首图', index: 7)]
    public string $image;

    #[ExcelProperty(value: '商品轮播图片', index: 8)]
    public string $images;

    #[ExcelProperty(value: '商品视频地址', index: 9)]
    public string $video;

    #[ExcelProperty(value: '分组ID', index: 10)]
    public string $category_id;

    #[ExcelProperty(value: '品牌ID', index: 11)]
    public string $brand_id;

    #[ExcelProperty(value: '商品状态', index: 12)]
    public string $status;

    #[ExcelProperty(value: '商品详情', index: 13)]
    public string $description;

    #[ExcelProperty(value: '商品上架时间', index: 14)]
    public string $on_sale_at;

    #[ExcelProperty(value: '商品下架时间', index: 15)]
    public string $off_sale_at;

    #[ExcelProperty(value: '商品来源(1拿货2第三方)', index: 16)]
    public string $source;

    #[ExcelProperty(value: '创建时间', index: 17)]
    public string $created_at;

    #[ExcelProperty(value: '修改时间', index: 18)]
    public string $updated_at;

    #[ExcelProperty(value: 'deleted_at', index: 19)]
    public string $deleted_at;
}
