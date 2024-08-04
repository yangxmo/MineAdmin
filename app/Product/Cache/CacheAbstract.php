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

namespace App\Product\Cache;

use Hyperf\Redis\RedisFactory;
use Hyperf\Redis\RedisProxy;

abstract class CacheAbstract
{
    protected string $prefix = 'task';

    protected string $typeName;

    protected RedisProxy $redis;

    public function __construct(string $redisType = 'default')
    {
        $this->redis = container()->get(RedisFactory::class)->get($redisType);
    }

    /**
     * 获取key.
     */
    public function getKey(string $key, string $tenantId = ':'): string
    {
        $this->prefix = $this->prefix ?? \Hyperf\Config\config('redis.default.prefix');

        return $this->prefix . $tenantId . trim($this->typeName, ':') . ':' . $key;
    }
}
