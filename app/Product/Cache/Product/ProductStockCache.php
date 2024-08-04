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

namespace App\Product\Cache\Product;

use App\Product\Cache\CacheAbstract;

class ProductStockCache extends CacheAbstract
{
    protected string $prefix = 'product';

    protected string $typeName = 'stock';

    public function __construct(string $redisType = 'product')
    {
        parent::__construct($redisType);
    }

    /**
     * 设置商品库存信息.
     * @throws \RedisException
     */
    public function setStockCache(string $platNo, ?string $skuId, int $stock): void
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $this->redis->set($key, $stock);
    }

    /**
     * 删除商品库存信息.
     * @throws \RedisException
     */
    public function delStockCache(string $platNo, ?string $skuId): void
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $this->redis->del($key);
    }

    /**
     * 获取商品库存信息.
     * @param mixed $platNo
     * @throws \RedisException
     */
    public function getInfoCache(string $platNo, string $skuId): int
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $result = $this->redis->get($key);

        return empty($result) ? 0 : (int) $result;
    }
}
