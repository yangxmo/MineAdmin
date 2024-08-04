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

use App\Product\Model\ProductCategory;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 商品分类Mapper类.
 */
class ProductCategoryMapper extends AbstractMapper
{
    /**
     * @var ProductCategory
     */
    public $model;

    public function assignModel()
    {
        $this->model = ProductCategory::class;
    }

    /**
     * 搜索处理器.
     */
    public function handleSearch(Builder $query, array $params): Builder
    {
        // 商品自增ID
        if (isset($params['id']) && filled($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        // 商品标识
        if (isset($params['product_no']) && filled($params['product_no'])) {
            $query->where('product_no', 'like', '%' . $params['product_no'] . '%');
        }

        // 名称
        if (isset($params['title']) && filled($params['title'])) {
            $query->where('title', 'like', '%' . $params['title'] . '%');
        }

        // 父级标识
        if (isset($params['parent_no']) && filled($params['parent_no'])) {
            $query->where('parent_no', 'like', '%' . $params['parent_no'] . '%');
        }

        // 创建时间
        if (isset($params['created_at']) && filled($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween(
                'created_at',
                [$params['created_at'][0], $params['created_at'][1]]
            );
        }

        // 修改时间
        if (isset($params['updated_at']) && filled($params['updated_at']) && is_array($params['updated_at']) && count($params['updated_at']) == 2) {
            $query->whereBetween(
                'updated_at',
                [$params['updated_at'][0], $params['updated_at'][1]]
            );
        }

        if (isset($params['deleted_at']) && filled($params['deleted_at']) && is_array($params['deleted_at']) && count($params['deleted_at']) == 2) {
            $query->whereBetween(
                'deleted_at',
                [$params['deleted_at'][0], $params['deleted_at'][1]]
            );
        }

        return $query;
    }
}
