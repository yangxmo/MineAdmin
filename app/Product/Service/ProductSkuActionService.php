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

namespace App\Product\Service;

use App\Product\Mapper\ProductSkuMapper;
use App\Product\ValueObject\SkuObject;
use Mine\Abstracts\AbstractService;
use Mine\Helper\Id;

class ProductSkuActionService extends AbstractService
{
    public $mapper;

    public function __construct(ProductSkuMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 保存ProductSku.
     * @throws \Exception
     */
    public function saveSkuByModelRelation(mixed $attributeValue, mixed $productObject, array $skuData): void
    {
        // 设置属性值
        $skuData['product_no'] = $productObject->product_no;
        empty($skuData['sku_no']) && $skuData['sku_no'] = (string) make(Id::class)->getId();
        $attributeValue->sku()->create($skuData);
    }

    /**
     * 准备ProductSku值对象（用于create和update方法）。
     */
    public function prepareProductSkuFromParams(array $params): SkuObject
    {
        $productInfo = new SkuObject();
        foreach ($params as $key => $value) {
            if (property_exists($productInfo, $key)) {
                $productInfo->{$key} = $value;
            }
        }
        return $productInfo;
    }
}
