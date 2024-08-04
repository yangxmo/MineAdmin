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
 * 商品分类验证数据类.
 */
class ProductCategoryRequest extends MineFormRequest
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
            // 品牌编码 验证
            'brand_no' => 'required',
            // 分组名称 验证
            'title' => 'required',
            // 分组图片 验证
            'image' => 'required',
            // 分组状态 验证
            'status' => 'required',
            // 分类排序 验证
            'sort' => 'required',
        ];
    }

    /**
     * 更新数据验证规则
     * return array.
     */
    public function updateRules(): array
    {
        return [
            // 品牌编码 验证
            'brand_no' => 'required',
            // 分组名称 验证
            'title' => 'required',
            // 分组图片 验证
            'image' => 'required',
            // 分组状态 验证
            'status' => 'required',
            // 分类排序 验证
            'sort' => 'required',
        ];
    }

    /**
     * 字段映射名称
     * return array.
     */
    public function attributes(): array
    {
        return [
            'brand_no' => '品牌编码',
            'title' => '分组名称',
            'image' => '分组图片',
            'status' => '分组状态',
            'sort' => '分类排序',
        ];
    }
}
