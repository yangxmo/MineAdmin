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
use App\Product\Event\ProductUpdateEvent;
use App\Product\Model\ProductInfo;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;

#[Listener]
class ProductUpdateListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            ProductUpdateEvent::class,
        ];
    }

    public function process(object $event): void
    {
        /** @var ProductInfo $productInfo */
        $productInfo = $event->getProductInfo();

        $productCache = container()->get(ProductInfoCache::class);
        $productSkuCache = container()->get(ProductSkuCache::class);
        $productStockCache = container()->get(ProductStockCache::class);

        $productCache->setInfoCache($productInfo->product_no, $productInfo->toArray());

        if (! empty($productInfo->sku()->count())) {
            $productInfo->sku()->each(function ($item) use ($productStockCache, $productSkuCache) {
                $productSkuCache->setInfoCache($item->product_no, $item->sku_no, $item->toArray());
                $productStockCache->setStockCache($item->product_no, $item->sku_no, $item->sale);
            });
        }
    }
}
