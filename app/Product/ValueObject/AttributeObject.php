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
 * 商品属性.
 */
class AttributeObject
{
    /**
     * @var string 商品属性名称
     */
    public string $attributes_name;

    /**
     * @var string 商品属性编号
     */
    public string $attributes_no = '';

    /**
     * @var string 商品编号
     */
    public string $product_no = '';

    /**
     * @var AttributeValueObject[] 商品属性值
     */
    public array $attributes_value;
}
