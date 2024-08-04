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

namespace App\Product\Request;

use Mine\MineFormRequest;

/**
 * 商品列表验证数据类.
 */
class ProductManageRequest extends MineFormRequest
{
    /**
     * 公共规则.
     */
    public function commonRules(): array
    {
        return [];
    }

    /**
     * 新增数据验证规则
     * return array.
     */
    public function saveRules(): array
    {
        return [
            // 商品名称 验证
            'name' => 'required',
            // 商品建议销售价 验证
            'price' => 'required',
            // 商品市场价 验证
            'market_price' => 'required',
            // 商品库存 验证
            'sale' => 'required',
            // 商品首图 验证
            'image' => 'required',
            // 商品轮播图片 验证
            'images' => 'required',
            // 分组ID 验证
            'category_id' => 'required',
            // 品牌ID 验证
            'brand_id' => 'required',
            // 商品状态 验证
            'status' => 'required',
            // 商品详情 验证
            'description' => 'required',
        ];
    }

    /**
     * 更新数据验证规则
     * return array.
     */
    public function updateRules(): array
    {
        return [
            // 商品名称 验证
            'name' => 'required|string|max:200',
            // 商品建议销售价 验证
            'price' => 'required|float|min:0|max:999999',
            // 商品市场价 验证
            'market_price' => 'required',
            // 商品库存 验证
            'sale' => 'required',
            // 商品首图 验证
            'image' => 'required',
            // 商品轮播图片 验证
            'images' => 'required',
            // 分组ID 验证
            'category_id' => 'required|integer',
            // 品牌ID 验证
            'brand_id' => 'required|integer',
            // 商品状态 验证
            'status' => 'required|integer',
            // 商品详情 验证
            'description' => 'required',
        ];
    }

    /**
     * 字段映射名称
     * return array.
     */
    public function attributes(): array
    {
        return [
            'name' => '商品名称',
            'price' => '商品建议销售价',
            'market_price' => '商品市场价',
            'sale' => '商品库存',
            'image' => '商品首图',
            'images' => '商品轮播图片',
            'category_id' => '分组ID',
            'brand_id' => '品牌ID',
            'status' => '商品状态',
            'description' => '商品详情',
        ];
    }
}
