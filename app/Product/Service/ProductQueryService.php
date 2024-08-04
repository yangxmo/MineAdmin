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

use App\Product\Cache\Product\ProductInfoCache;
use App\Product\Mapper\ProductInfoMapper;
use Hyperf\Database\Model\Collection;
use Hyperf\Di\Annotation\Inject;
use Mine\Abstracts\AbstractService;

class ProductQueryService extends AbstractService
{
    public $mapper;

    #[Inject]
    protected ProductInfoCache $productInfoCache;

    public function __construct(ProductInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 获取商品信息.
     */
    public function findByIds(array $ids, array $column = ['*']): Collection
    {
        return $this->mapper->model::findMany($ids, $column);
    }

    /**
     * 获取商品信息.
     */
    public function getInfo(string $productNo): array
    {
        return $this->productInfoCache->getInfoCache($productNo);
    }
}
