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

use App\Product\Entity\ProductEntity;
use App\Product\Mapper\ProductInfoMapper;
use App\Product\Model\ProductInfo;
use App\Product\Trait\ProductAttributeTrait;
use App\Product\Vo\AttributeValueVo;
use App\Product\Vo\AttributeVo;
use App\Product\Vo\SkuVo;
use Hyperf\Database\Model\Model;
use Hyperf\DbConnection\Db;
use Mine\Abstracts\AbstractService;
use Mine\MineModel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

use function Hyperf\Collection\collect;

/**
 * 商品列表服务类.
 */
class ProductManageService extends AbstractService
{
    use ProductAttributeTrait;

    /**
     * @var ProductInfoMapper
     */
    public $mapper;

    public function __construct(ProductInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 读取商品.
     */
    public function read(mixed $id, array $column = ['*']): ?MineModel
    {
        return $this->mapper->getInfoByProductNo($id);
    }

    /**
     * 创建商品.
     */
    public function create(array $data): bool
    {
        $productEntity = $this->prepareProductFromParams($data);

        return Db::transaction(function () use ($productEntity) {
            // 调用领域服务进行创建数据
            $productInfo = $this->mapper->create(collect($productEntity)->toArray());
            // 创建attribute
            $this->saveAttribute($productEntity, $productInfo);
            // 保存sku
            $this->saveSku($productEntity, $productInfo);
            return true;
        });
    }

    /**
     * 更新商品.
     */
    public function update(mixed $id, array $data): bool
    {
        $data['product_no'] = $id;
        $productEntity = $this->prepareProductFromParams($data);
        // 获取锁
        return Db::transaction(function () use ($productEntity) {
            // 调用领域服务进行创建数据
            $this->mapper->updateOrCreate(['product_no' => $productEntity->getProductNo()], collect($productEntity)->toArray());
            // 获取商品信息
            $productInfo = $this->mapper->first(['product_no' => $productEntity->getProductNo()], ['product_no']);
            // 修改attribute
            $this->saveAttribute($productEntity, $productInfo);
            // 保存sku
            $this->saveSku($productEntity, $productInfo);
            return true;
        });
    }

    /**
     * 保存属性.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function saveAttribute(ProductEntity $productEntity, ProductInfo $productInfo): void
    {
        // 获取当下所有属性编号
        $attributeNoList = collect($productEntity->getAttributes())->pluck('attributes_no')->toArray();
        // 删除多余的属性
        $productInfo->attributes()->whereNotIn('attributes_no', $attributeNoList)->delete();
        // 创建属性
        array_map(function (AttributeVo $item) use ($productInfo) {
            // 设置属性
            $attribute = $productInfo->attributes()->updateOrCreate(['attributes_no' => $item->getAttributesNo()], collect($item)->toArray());
            // 设置属性值
            $this->saveAttributeValue($attribute, $item->getAttributesValue());
        }, $productEntity->getAttributes());
    }

    /**
     * 保存属性值.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    private function saveAttributeValue(Model $attribute, array $attributeValueData): void
    {
        // 获取当下所有属性值编号
        $attributeNoList = collect($attributeValueData)->pluck('attr_value_no')->toArray();
        // 删除多余的属性
        $attribute->attributeValue()->whereNotIn('attr_value_no', $attributeNoList)->delete();
        // 创建属性值
        array_map(function (AttributeValueVo $item) use ($attribute) {
            // 设置属性值
            $attribute->attributeValue()->updateOrCreate(['attr_value_no' => $item->getAttrValueNo()], collect($item)->toArray());
        }, $attributeValueData);
    }

    /**
     * 保存sku.
     * @throws \Exception
     */
    private function saveSku(ProductEntity $productEntity, ProductInfo $productInfo): void
    {
        // 获取当下所有属性值编号
        $skuNoList = collect($productEntity->getSkus())->pluck('sku_no')->toArray();
        // 删除多余的属性
        $productInfo->sku()->whereNotIn('sku_no', $skuNoList)->delete();
        // 创建属性值
        array_map(function (SkuVo $item) use ($productInfo) {
            // 设置属性值
            $productInfo->sku()->updateOrCreate(['sku_no' => $item->getSkuNo()], collect($item)->toArray());
        }, $productEntity->getSkus());
    }
}
