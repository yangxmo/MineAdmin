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
use Mine\MineModel;

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
     * 获取商品信息.
     */
    public function getInfoByProductNo(string $productNo, array $column = ['*']): ?MineModel
    {
        return $this->model::query()->with(['attributes', 'attributes.attributeValue', 'sku'])->where('product_no', $productNo)->first($column);
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
     * 更新数据.
     */
    public function updateOrCreate(array $conditions, array $data): ProductInfo
    {
        $this->filterExecuteAttributes($data, $this->getModel()->incrementing);
        return $this->model::updateOrCreate($conditions, $data);
    }

    /**
     * 获取列表.
     */
    public function getPageList(?array $params, bool $isScope = true, string $pageName = 'page'): array
    {
        $paginate = $this->listQuerySetting($params, $isScope)
            ->with(['brand', 'category'])
            ->paginate(
                (int) ($params['pageSize'] ?? $this->model::PAGE_SIZE),
                ['*'],
                $pageName,
                (int) ($params[$pageName] ?? 1)
            );
        return $this->setPaginate($paginate, $params);
    }

    /**
     * 搜索处理器.
     */
    public function handleSearch(Builder $query, array $params): Builder
    {
        // 商品自增ID
        if (isset($params['productNos']) && filled($params['productNos'])) {
            $query->whereIn('product_no', $params['productNos']);
        }

        // 商品标识
        if (isset($params['product_no']) && filled($params['product_no'])) {
            $query->where('product_no', 'like', '%' . $params['product_no'] . '%');
        }

        // 商品名称
        if (isset($params['name']) && filled($params['name'])) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        // 分组ID
        if (isset($params['category_no']) && filled($params['category_no'])) {
            $query->where('category_no', '=', $params['category_no']);
        }

        // 品牌ID
        if (isset($params['brand_no']) && filled($params['brand_no'])) {
            $query->where('brand_no', '=', $params['brand_no']);
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
