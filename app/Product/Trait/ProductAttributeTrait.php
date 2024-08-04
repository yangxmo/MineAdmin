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

namespace App\Product\Trait;

use App\Product\Entity\SpuEntity;
use App\Product\Service\ProductSkuActionService;
use App\Product\ValueObject\AttributeObject;

use function Hyperf\Collection\collect;

trait ProductAttributeTrait
{
    /**
     * 准备Product实体对象（用于create和update方法）。
     */
    protected function prepareProductFromParams(array $params): SpuEntity
    {
        $productInfo = new SpuEntity();
        foreach ($params as $key => $value) {
            if ($key === 'attributes') {
                $productInfo->attributes = collect($value)->map(function ($item) {
                    return $this->prepareProductAttributeFromParams($item);
                })->toArray();
            }

            if (property_exists($productInfo, $key)) {
                $productInfo->{$key} = $value;
            }
        }
        return $productInfo;
    }

    /**
     * 准备Product值对象（用于create和update方法）。
     */
    protected function prepareProductAttributeFromParams(array $params): AttributeObject
    {
        $productInfo = new AttributeObject();
        // 设置属性
        $productSkuObject = container()->get(ProductSkuActionService::class);
        foreach ($params as $key => $value) {
            if (property_exists($productInfo, $key)) {
                if ($key === 'sku') {
                    $productInfo->{$key} = $productSkuObject->prepareProductSkuFromParams($value);
                } else {
                    $productInfo->{$key} = $value;
                }
            }
        }
        return $productInfo;
    }
}
