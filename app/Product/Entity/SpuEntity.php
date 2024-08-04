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

namespace App\Product\Entity;

use App\Product\ValueObject\AttributeObject;

class SpuEntity
{
    /**
     * 商品编码.
     */
    public string $product_no = '';

    /**
     * 商品名称.
     */
    public string $name = '';

    /**
     * 商品价格
     */
    public float $price = 0;

    /**
     * 商品市场价.
     */
    public float $market_price = 0;

    /**
     * 商品主图片.
     */
    public string $image = '';

    /**
     * 商品轮播图片.
     */
    public array $images = [];

    /**
     * 商品视频.
     */
    public string $video = '';

    /**
     * 商品分类ID.
     */
    public int $category_id = 0;

    /**
     * 商品品牌ID.
     */
    public int $brand_id = 0;

    /**
     * 商品状态
     */
    public int $status = 1;

    /**
     * 商品描述.
     */
    public string $description = '';

    /**
     * @var attributeObject[] 商品属性
     */
    public array $attributes = [];
}
