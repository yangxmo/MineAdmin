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

namespace App\Product\Listener;

use App\Product\Cache\Product\ProductInfoCache;
use App\Product\Cache\Product\ProductSkuCache;
use App\Product\Cache\Product\ProductStockCache;
use App\Product\Event\ProductDeleteEvent;
use App\Product\Model\ProductInfo;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class ProductDeleteListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            ProductDeleteEvent::class,
        ];
    }

    public function process(object $event): void
    {
        /** @var ProductInfo $productInfo */
        $productInfo = $event->getProductInfo();

        $productCache = container()->get(ProductInfoCache::class);
        $productSkuCache = container()->get(ProductSkuCache::class);
        $productStockCache = container()->get(ProductStockCache::class);

        $productCache->delInfoCache($productInfo->product_no);

        if (! empty($productInfo->sku()->count())) {
            $productInfo->sku()->each(function ($item) use ($productStockCache, $productSkuCache) {
                $productStockCache->delStockCache($item->product_no, $item->sku_no);
                $productSkuCache->delInfoCache($item->product_no, $item->sku_no);
            });
        }
    }
}
