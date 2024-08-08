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

namespace App\Product\Vo;

/**
 * 商品属性值.
 */
class AttributeValueVo
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

    public function setProductNo(string $string): self
    {
        $this->product_no = $string;
        return $this;
    }

    public function setAttributesNo(string $string): self
    {
        $this->attributes_no = $string;
        return $this;
    }

    public function setAttrValueNo(string $string): self
    {
        $this->attr_value_no = $string;
        return $this;
    }

    public function setAttrValue(string $string): self
    {
        $this->attr_value = $string;
        return $this;
    }

    public function getProductNo(): string
    {
        return $this->product_no;
    }

    public function getAttributesNo(): string
    {
        return $this->attributes_no;
    }

    public function getAttrValueNo(): string
    {
        return $this->attr_value_no;
    }

    public function getAttrValue(): string
    {
        return $this->attr_value;
    }
}
