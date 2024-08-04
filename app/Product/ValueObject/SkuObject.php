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

namespace App\Product\ValueObject;

/**
 * 商品sku.
 */
class SkuObject
{
    /**
     * @var string 商品编号
     */
    public string $product_no = '';

    /**
     * @var string 商品属性编号
     */
    public string $attr_no = '';

    /**
     * @var string 商品属性值编号
     */
    public string $attr_value_no = '';

    /**
     * @var string sku编号
     */
    public string $sku_no = '';

    /**
     * @var string 商品sku名称
     */
    public string $name;

    /**
     * @var string 商品sku编码
     */
    public string $value;

    /**
     * @var string 商品sku图片
     */
    public string $image;

    /**
     * @var string 商品sku视频
     */
    public string $video = '';

    /**
     * @var int 商品sku库存
     */
    public int $sale = 0;

    /**
     * @var float 商品sku价格
     */
    public float $price = 0;

    /**
     * @var float 商品sku市场价格
     */
    public float $market_price = 0;

    /**
     * @var int 商品sku状态
     */
    public int $status = 1;

    /**
     * @var int 商品sku排序
     */
    public int $sort = 0;
}
