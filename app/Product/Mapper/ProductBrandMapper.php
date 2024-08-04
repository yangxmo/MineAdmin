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

use App\Product\Model\ProductBrand;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 商品品牌Mapper类.
 */
class ProductBrandMapper extends AbstractMapper
{
    /**
     * @var ProductBrand
     */
    public $model;

    public function assignModel()
    {
        $this->model = ProductBrand::class;
    }

    /**
     * 搜索处理器.
     */
    public function handleSearch(Builder $query, array $params): Builder
    {
        // 自增ID
        if (isset($params['id']) && filled($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        // 第三方唯一标识
        if (isset($params['plat_no']) && filled($params['plat_no'])) {
            $query->where('plat_no', 'like', '%' . $params['plat_no'] . '%');
        }

        // 唯一编码
        if (isset($params['brand_no']) && filled($params['brand_no'])) {
            $query->where('brand_no', 'like', '%' . $params['brand_no'] . '%');
        }

        // 品牌名称
        if (isset($params['name']) && filled($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        // 品牌图片
        if (isset($params['image']) && filled($params['image'])) {
            $query->where('image', '=', $params['image']);
        }

        // 品牌状态
        if (isset($params['status']) && filled($params['status'])) {
            $query->where('status', '=', $params['status']);
        }

        // 排序
        if (isset($params['sort']) && filled($params['sort'])) {
            $query->where('sort', '=', $params['sort']);
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
