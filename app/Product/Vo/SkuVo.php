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
 * 商品sku.
 */
class SkuVo
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

    public function setProductNo(string $productNo): self
    {
        $this->product_no = $productNo;
        return $this;
    }

    public function setAttrNo(string $attrNo): self
    {
        $this->attr_no = $attrNo;
        return $this;
    }

    public function setAttrValueNo(string $attrValueNo): self
    {
        $this->attr_value_no = $attrValueNo;
        return $this;
    }

    public function setSkuNo(string $skuNo): self
    {
        $this->sku_no = $skuNo;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setVideo(string $video): self
    {
        $this->video = $video;
        return $this;
    }

    public function setSale(int $sale): self
    {
        $this->sale = $sale;
        return $this;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function setMarketPrice(float $marketPrice): self
    {
        $this->market_price = $marketPrice;
        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setSort(int $sort): self
    {
        $this->sort = $sort;
        return $this;
    }

    public function setSpecValueIds(mixed $spec_value)
    {
        $this->value = $spec_value;
        return $this;
    }

    public function getProductNo(): string
    {
        return $this->product_no;
    }

    public function getAttrNo(): string
    {
        return $this->attr_no;
    }

    public function getAttrValueNo(): string
    {
        return $this->attr_value_no;
    }

    public function getSkuNo(): string
    {
        return $this->sku_no;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getVideo(): string
    {
        return $this->video;
    }

    public function getSale(): int
    {
        return $this->sale;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getMarketPrice(): float
    {
        return $this->market_price;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getSort(): int
    {
        return $this->sort;
    }
}
