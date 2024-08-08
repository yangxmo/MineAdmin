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

use App\Product\Entity\ProductEntity;
use App\Product\Vo\AttributeValueVo;
use App\Product\Vo\AttributeVo;
use App\Product\Vo\SkuVo;
use Mine\Helper\Str;

use function Hyperf\Support\value;

trait ProductAttributeTrait
{
    /**
     * 准备Product实体对象（用于create和update方法）。
     */
    protected function prepareProductFromParams(array $params): ProductEntity
    {
        $productInfo = new ProductEntity();

        $productNo = $params['product_no'] ?? Str::random(10);

        $productInfo->setProductNo($productNo);
        $productInfo->setName($params['name']);
        $productInfo->setPrice($params['price']);
        $productInfo->setMarketPrice($params['market_price']);
        $productInfo->setImage($params['image']);
        $productInfo->setImages($params['images'] ?? []);
        $productInfo->setVideo($params['video'] ?? '');
        $productInfo->setSale($params['sale']);
        $productInfo->setCategoryNo($params['category_no']);
        $productInfo->setBrandNo($params['brand_no']);
        $productInfo->setStatus($params['status'] ?? 1);
        $productInfo->setDescription($params['description']);
        // 设置属性
        if (! empty($params['specs'])) {
            $attributeVos = $this->prepareProductAttributeFromParams($productInfo, $params['specs'], $productNo);
            $productInfo->setAttributes($attributeVos);
        }
        return $productInfo;
    }

    /**
     * 准备Product值对象（用于create和update方法）。
     */
    protected function prepareProductAttributeFromParams(ProductEntity $productEntity, array $specs, string $productNo): array
    {
        // 初始化 AttributeVo 和 AttributeValueVo 数组
        $skuVos = [];
        $attributeVos = [];
        $attributeValueVos = [];
        $attributeValueNos = [];

        // 处理 specs 数据
        foreach ($specs as $spec) {
            $names = $spec['names'];
            $values = $spec['values'];
            $optionsData = $spec['options'];

            // 处理 AttributeVo
            foreach ($names as $name) {
                $attributesNo = $name['attributes_no'] ?? Str::random(10);
                $attributeVo = new AttributeVo();
                $attributeVo->setProductNo($productNo);
                $attributeVo->setAttributesNo($attributesNo);
                $attributeVo->setAttributesName($name['name']);
                $attributeVos[] = $attributeVo;
                // 处理 AttributeValueVo
                foreach ($values as $value) {
                    if ($value['spec_name_id'] === $name['id']) {
                        $attrValueNo = $value['attr_value_no'] ?? Str::random(10);
                        $attributeValueVo = new AttributeValueVo();
                        $attributeValueVo->setProductNo($productNo);
                        $attributeValueVo->setAttributesNo($attributesNo);
                        $attributeValueVo->setAttrValueNo($attrValueNo);
                        $attributeValueVo->setAttrValue($value['name']);
                        $attributeValueVos[] = $attributeValueVo;
                        $attributeValueNos[$value['id']] = $attrValueNo;
                        $attrValueNo = null;
                    }
                }
                // 将 AttributeValueVo 添加到 AttributeVo
                $attributeVo->setAttributesValue($attributeValueVos);
                $attributeValueVos = [];
            }
            // 将 AttributeVo 添加到 ProductEntity
            $productEntity->setAttributes($attributeVos);
            // 处理 SkuVo
            foreach ($optionsData as $option) {
                $valueIds = value(function () use ($option, $attributeValueNos) {
                    $valueIds = [];
                    foreach ($option['spec_value_id'] as $valueId) {
                        ! empty($attributeValueNos[$valueId]) && $valueIds[] = $attributeValueNos[$valueId];
                    }
                    return implode('_', $valueIds);
                });
                $skuVo = new SkuVo();
                $skuVo->setProductNo($productNo);
                $skuVo->setSkuNo($valueIds);
                $skuVo->setName($option['name']);
                $skuVo->setPrice($option['price']);
                $skuVo->setMarketPrice($option['market_price']);
                $skuVo->setSale($option['sale']);
                $skuVo->setImage($option['image']);
                $skuVo->setVideo($option['video']);
                $skuVo->setAttrValueNo($valueIds);
                $skuVo->setSpecValueIds($valueIds);
                $skuVos[] = $skuVo;
            }

            $productEntity->setSkus($skuVos);
        }

        return $attributeVos;
    }
}
