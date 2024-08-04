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

namespace App\Order\Request;

use Mine\MineFormRequest;

/**
 * 订单列表验证数据类.
 */
class OrderInfoRequest extends MineFormRequest
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
    public function indexRules(): array
    {
        return [
            'order_sn' => 'nullable|string',
            'order_type' => 'required|integer|min:1',
            'order_status' => 'nullable|integer|min:1',
            'order_pay_status' => 'nullable|integer|min:1',
            'order_refund_status' => 'nullable|integer|min:1',
            'order_refund_type' => 'nullable|integer|min:1',
            'order_user_id' => 'nullable|integer|min:1',
            'order_pay_type' => 'nullable|integer|min:1',
            'order_close_time' => 'nullable|array',
            'order_pay_time' => 'nullable|array',
            'created_at' => 'nullable|array',
            'order_pay_source' => 'nullable|integer|in:1,2,3,4,5,6,7',
        ];
    }

    /**
     * 新增数据验证规则
     * return array.
     */
    public function saveRules(): array
    {
        return [
        ];
    }

    /**
     * 更新数据验证规则
     * return array.
     */
    public function updateRules(): array
    {
        return [
        ];
    }

    /**
     * 字段映射名称
     * return array.
     */
    public function attributes(): array
    {
        return [
            'id' => '订单ID',
            'order_sn' => '订单编号',
            'order_price' => '总金额',
            'order_discount_price' => '优惠金额',
            'order_freight_price' => '运费金额',
            'order_pay_price' => '支付金额',
            'order_user_id' => '用户ID',
            'order_type' => '订单类型',
            'order_status' => '订单状态',
            'order_pay_status' => '支付状态',
            'order_refund_status' => '退款状态',
            'order_refund_type' => '退款类型',
            'order_pay_type' => '支付方式',
            'order_pay_source' => '支付源',
        ];
    }
}
