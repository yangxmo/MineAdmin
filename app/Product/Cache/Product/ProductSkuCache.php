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
use Hyperf\Codec\Json;

class ProductSkuCache extends CacheAbstract
{
    protected string $prefix = 'product';

    protected string $typeName = 'sku';

    public function __construct(string $redisType = 'product')
    {
        parent::__construct($redisType);
    }

    /**
     * 设置商品信息.
     * @throws \RedisException
     */
    public function setInfoCache(string $platNo, ?string $skuId, array $data): void
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $this->redis->hSet($key, $platNo, Json::encode($data));
    }

    /**
     * 删除商品信息.
     * @throws \RedisException
     */
    public function delInfoCache(string $platNo, ?string $skuId): void
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $this->redis->hDel($key, $platNo);
    }

    /**
     * 获取商品信息.
     * @throws \RedisException
     */
    public function getInfoCache(string $platNo, ?string $skuId): array
    {
        if ($skuId) {
            $key = $this->getKey("{$platNo}_{$skuId}");
        } else {
            $key = $this->getKey("{$platNo}");
        }

        $result = $this->redis->hGet($key, $platNo);

        return $result ? Json::decode($result) : [];
    }
}
