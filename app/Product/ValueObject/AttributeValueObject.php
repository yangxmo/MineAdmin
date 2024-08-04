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
 * 商品属性值.
 */
class AttributeValueObject
{
    /**
     * @var string 商品编号
     */
    public string $product_no = '';

    /**
     * @var string 商品属性编号
     */
    public string $attributes_no = '';

    /**
     * @var string 商品属性值编号
     */
    public string $attr_value_no = '';

    /**
     * @var string 商品属性值名称
     */
    public string $attr_value = '';

    /**
     * @var SkuObject sku数据
     */
    public SkuObject $skuObject;
}
