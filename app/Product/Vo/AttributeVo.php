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
 * 商品属性.
 */
class AttributeVo
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
     * @var AttributeValueVo[] 商品属性值
     */
    public array $attributes_value;

    /**
     * 设置商品属性名称.
     *
     * @param string $attributesName 商品属性名称
     */
    public function setAttributesName(string $attributesName): self
    {
        $this->attributes_name = $attributesName;
        return $this;
    }

    /**
     * 设置商品属性编号.
     *
     * @param string $attributesNo 商品属性编号
     */
    public function setAttributesNo(string $attributesNo): self
    {
        $this->attributes_no = $attributesNo;
        return $this;
    }

    /**
     * 设置商品编号.
     *
     * @param string $productNo 商品编号
     */
    public function setProductNo(string $productNo): self
    {
        $this->product_no = $productNo;
        return $this;
    }

    /**
     * 设置商品属性值.
     *
     * @param AttributeValueVo[] $attributesValue 商品属性值数组
     */
    public function setAttributesValue(array $attributesValue): self
    {
        $this->attributes_value = $attributesValue;
        return $this;
    }

    /**
     * 获取商品属性名称.
     *
     * @return string 商品属性名称
     */
    public function getAttributesName(): string
    {
        return $this->attributes_name;
    }

    /**
     * 获取商品属性编号.
     *
     * @return string 商品属性编号
     */
    public function getAttributesNo(): string
    {
        return $this->attributes_no;
    }

    /**
     * 获取商品编号.
     *
     * @return string 商品编号
     */
    public function getProductNo(): string
    {
        return $this->product_no;
    }

    /**
     * 获取商品属性值.
     *
     * @return AttributeValueVo[] 商品属性值数组
     */
    public function getAttributesValue(): array
    {
        return $this->attributes_value;
    }
}
