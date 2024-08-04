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

use App\Product\Mapper\ProductBrandMapper;
use Mine\Abstracts\AbstractService;

/**
 * 商品品牌服务类.
 */
class ProductBrandService extends AbstractService
{
    /**
     * @var ProductBrandMapper
     */
    public $mapper;

    public function __construct(ProductBrandMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}
