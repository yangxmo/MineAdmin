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

use App\Product\Mapper\ProductSkuMapper;
use Mine\Abstracts\AbstractService;

class ProductSkuActionService extends AbstractService
{
    public $mapper;

    public function __construct(ProductSkuMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}
