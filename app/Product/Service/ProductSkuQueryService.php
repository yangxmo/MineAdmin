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

use App\Product\Cache\Product\ProductSkuCache;
use App\Product\Cache\Product\ProductStockCache;
use App\Product\Mapper\ProductSkuMapper;
use Hyperf\Di\Annotation\Inject;
use Mine\Abstracts\AbstractService;

class ProductSkuQueryService extends AbstractService
{
    public $mapper;

    #[Inject]
    protected ProductSkuCache $productSkuCache;

    #[Inject]
    protected ProductStockCache $productStockCache;

    public function __construct(ProductSkuMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 获取商品sku信息.
     * @throws \RedisException
     */
    public function getSkuInfoBySkuId(string $platNo, string $skuId): array
    {
        // 如果缓存有数据，则直接返回, 不做数据库查询再写入，写入部分都交由商品编辑部分处理
        return $this->productSkuCache->getInfoCache($platNo, $skuId);
    }

    /**
     * 获取商品sku库存.
     * @throws \RedisException
     */
    public function getSkuStockBySkuId(string $platNo, string $skuId): int
    {
        // 如果缓存有数据，则直接返回, 不做数据库查询再写入，写入部分都交由商品编辑部分处理
        return $this->productStockCache->getInfoCache($platNo, $skuId);
    }
}
