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

use App\Product\Vo\AttributeVo;
use App\Product\Vo\SkuVo;

class ProductEntity
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
     * 商品销量.
     */
    public int $sale = 0;

    /**
     * 商品分类编号.
     */
    public string $category_no = '';

    /**
     * 商品品牌编号.
     */
    public string $brand_no = '';

    /**
     * 商品状态
     */
    public int $status = 1;

    /**
     * 商品描述.
     */
    public string $description = '';

    /**
     * @var AttributeVo[] 商品属性
     */
    public array $attributes = [];

    /**
     * @var SkuVo[] 商品Sku
     */
    public array $skus = [];

    public function setProductNo(string $productNo): self
    {
        $this->product_no = $productNo;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
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

    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;
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

    public function setCategoryNo(string $categoryNo): self
    {
        $this->category_no = $categoryNo;
        return $this;
    }

    public function setBrandNo(string $brandNo): self
    {
        $this->brand_no = $brandNo;
        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function setSkus(array $skus): self
    {
        $this->skus = $skus;
        return $this;
    }

    public function getSkus(): array
    {
        return $this->skus;
    }

    public function getProductNo(): string
    {
        return $this->product_no;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getMarketPrice(): float
    {
        return $this->market_price;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function getVideo(): string
    {
        return $this->video;
    }

    public function getSale(): int
    {
        return $this->sale;
    }

    public function getCategoryNo(): string
    {
        return $this->category_no;
    }

    public function getBrandNo(): string
    {
        return $this->brand_no;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
