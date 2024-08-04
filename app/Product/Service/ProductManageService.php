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

use App\Product\Mapper\ProductInfoMapper;
use Mine\Abstracts\AbstractService;

/**
 * 商品列表服务类.
 */
class ProductManageService extends AbstractService
{
    /**
     * @var ProductInfoMapper
     */
    public $mapper;

    public function __construct(ProductInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}
