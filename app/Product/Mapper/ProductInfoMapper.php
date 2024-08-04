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

use App\Product\Model\ProductInfo;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 商品列表Mapper类.
 */
class ProductInfoMapper extends AbstractMapper
{
    /**
     * @var ProductInfo
     */
    public $model;

    public function assignModel()
    {
        $this->model = ProductInfo::class;
    }

    /**
     * 新增数据.
     */
    public function create(array $data): ProductInfo
    {
        $this->filterExecuteAttributes($data, $this->getModel()->incrementing);
        return $this->model::create($data);
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

        // 三方标识
        if (isset($params['product_plat_no']) && filled($params['product_plat_no'])) {
            $query->where('product_plat_no', 'like', '%' . $params['product_plat_no'] . '%');
        }

        // 商品名称
        if (isset($params['name']) && filled($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        // 分组ID
        if (isset($params['category_id']) && filled($params['category_id'])) {
            $query->where('category_id', '=', $params['category_id']);
        }

        // 品牌ID
        if (isset($params['brand_id']) && filled($params['brand_id'])) {
            $query->where('brand_id', '=', $params['brand_id']);
        }

        // 商品状态
        if (isset($params['status']) && filled($params['status'])) {
            $query->where('status', '=', $params['status']);
        }

        // 商品上架时间
        if (isset($params['on_sale_at']) && filled($params['on_sale_at']) && is_array($params['on_sale_at']) && count($params['on_sale_at']) == 2) {
            $query->whereBetween(
                'on_sale_at',
                [$params['on_sale_at'][0], $params['on_sale_at'][1]]
            );
        }

        // 商品下架时间
        if (isset($params['off_sale_at']) && filled($params['off_sale_at']) && is_array($params['off_sale_at']) && count($params['off_sale_at']) == 2) {
            $query->whereBetween(
                'off_sale_at',
                [$params['off_sale_at'][0], $params['off_sale_at'][1]]
            );
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

        return $query;
    }
}
