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

use App\Product\Mapper\ProductCategoryMapper;
use Mine\Abstracts\AbstractService;

/**
 * 商品分类服务类.
 */
class ProductCategoryService extends AbstractService
{
    /**
     * @var ProductCategoryMapper
     */
    public $mapper;

    public function __construct(ProductCategoryMapper $mapper)
    {
        $this->mapper = $mapper;
    }
}
