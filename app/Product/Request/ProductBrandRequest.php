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
 * 商品品牌验证数据类.
 */
class ProductBrandRequest extends MineFormRequest
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
            // 品牌名称 验证
            'name' => 'required',
            // 品牌状态 验证
            'status' => 'required',
            // 排序 验证
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
            // 品牌名称 验证
            'name' => 'required',
            // 品牌状态 验证
            'status' => 'required',
            // 排序 验证
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
            'id' => '自增ID',
            'plat_no' => '第三方唯一标识',
            'name' => '品牌名称',
            'status' => '品牌状态',
            'sort' => '排序',
        ];
    }
}
