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

use App\Product\Entity\SpuEntity;
use App\Product\Mapper\ProductInfoMapper;
use App\Product\Redis\LockRedis;
use App\Product\Trait\ProductAttributeTrait;
use Hyperf\DbConnection\Db;
use Mine\Abstracts\AbstractService;
use Mine\Helper\Id;
use Mine\MineModel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

use function Hyperf\Collection\collect;

class ProductActionService extends AbstractService
{
    use ProductAttributeTrait;

    public $mapper;

    public function __construct(ProductInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 创建商品.
     */
    public function create(array $data): bool
    {
        $productInfo = $this->prepareProductFromParams($data);

        return Db::transaction(function () use ($productInfo) {
            $productInfo->product_no = (string) make(Id::class)->getId();
            // 调用领域服务进行创建数据
            $productObject = $this->mapper->create(collect($productInfo)->toArray());
            // 创建attribute
            $this->saveAttribute($productInfo, $productObject);
            return true;
        });
    }

    /**
     * 更新商品.
     */
    public function update(mixed $id, array $data): bool
    {
        $productInfoData = $this->prepareProductFromParams($data);

        /** @var LockRedis $lockRedis */
        $lockRedis = container()->get(LockRedis::class);
        // 获取锁
        return Db::transaction(function () use ($productInfoData, $lockRedis) {
            // 获取锁
            $lockRedis->run(function () use ($productInfoData) {
                // 调用领域服务进行创建数据
                $this->updateByCondition(['product_no' => $productInfoData->product_no], collect($productInfoData)->toArray());
                // 获取商品信息
                $productObject = $this->mapper->first(['product_no' => $productInfoData->product_no], ['product_no']);
                // 修改attribute
                $this->saveAttribute($productInfoData, $productObject);
            }, $productInfoData->product_no, 3);

            return true;
        });
    }

    /**
     * 使用乐观锁进行库存扣除.
     */
    public function decStock(array $item): bool
    {
        $prefix = config('databases.default.prefix');

        // 使用update锁进行乐观锁进行库存扣除.
        $sql = array_map(function ($item) use ($prefix) {
            if (empty($item['sku_no'])) {
                // 组装sql语句
                return "UPDATE {$prefix}product_info SET sale = sale - {$item['num']} WHERE product_no = '{$item['item_no']}' AND sale >= {$item['num']}";
            }
            // 组装sql语句
            return "UPDATE {$prefix}product_sku SET sale = sale - {$item['num']} WHERE product_no = '{$item['item_no']}' AND sku_no = {$item['sku_no']} AND sale >= {$item['num']}";
        }, $item);

        return Db::unprepared(implode('', $sql));
    }

    /**
     * 回滚库存.
     */
    public function incStock(array $item): bool
    {
        $prefix = config('databases.default.prefix');

        $sql = array_map(function ($item) use ($prefix) {
            if (empty($item['sku_no'])) {
                // 组装sql语句
                return "UPDATE {$prefix}product_info SET sale = sale + {$item['num']} WHERE product_no = '{$item['item_no']}'";
            }
            // 组装sql语句
            return "UPDATE {$prefix}product_sku SET sale = sale + {$item['num']} WHERE product_no = '{$item['item_no']}' AND sku_no = {$item['sku_no']}";
        }, $item);

        return Db::unprepared(implode('', $sql));
    }

    /**
     * 保存属性.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function saveAttribute(SpuEntity $productInfo, MineModel $productObject): void
    {
        array_map(function ($item) use ($productObject) {
            // 设置属性
            empty($item['attributes_no']) && $item['attributes_no'] = (string) make(Id::class)->getId();
            $attribute = $productObject->attributes()->updateOrCreate(['attributes_no' => $item['attributes_no']], $item);
            // 设置属性值
            $this->saveAttributeValue($attribute, $productObject, $item['attributes_value']);
        }, $productInfo->attributes);
    }

    /**
     * 保存属性值.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Exception
     */
    private function saveAttributeValue(mixed $attribute, MineModel $productObject, array $attributeValueData): void
    {
        $productSkuObject = container()->get(ProductSkuActionService::class);
        // 创建属性值
        array_map(function ($item) use ($attribute, $productObject, $productSkuObject) {
            // 设置属性值
            $item['product_no'] = $productObject->product_no;
            empty($item['attr_value_no']) && $item['attr_value_no'] = (string) make(Id::class)->getId();
            $attributeValue = $attribute->attributeValue()->create($item);
            $productSkuObject->saveSkuByModelRelation($attributeValue, $productObject, $item['sku']);
        }, $attributeValueData);
    }
}
