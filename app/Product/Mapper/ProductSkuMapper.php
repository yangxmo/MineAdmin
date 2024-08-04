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

namespace App\Product\Mapper;

use App\Product\Model\ProductSku;
use Mine\Abstracts\AbstractMapper;
use Mine\MineModel;

class ProductSkuMapper extends AbstractMapper
{
    /**
     * @var ProductSku
     */
    public $model;

    public function assignModel()
    {
        $this->model = ProductSku::class;
    }

    public function info(mixed $id, string $key = 'id', array $column = ['*']): ?MineModel
    {
        return $this->model::query()->where($key, $id)->first($column);
    }

    public function getStockBySkuId(string $skuId): int
    {
        return $this->model::query()->where('sku_no', $skuId)->value('sale');
    }
}
