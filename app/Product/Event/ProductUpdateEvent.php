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

namespace App\Product\Event;

use App\Product\Model\ProductInfo;

class ProductUpdateEvent
{
    protected ProductInfo $productInfo;

    public function __construct(ProductInfo $productInfo)
    {
        $this->productInfo = $productInfo;
    }

    public function getProductInfo(): ProductInfo
    {
        return $this->productInfo;
    }
}
