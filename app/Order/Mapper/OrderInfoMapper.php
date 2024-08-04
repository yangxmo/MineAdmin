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

namespace App\Order\Mapper;

use App\Order\Model\OrderInfo;
use Hyperf\Database\Model\Builder;
use Mine\Abstracts\AbstractMapper;

/**
 * 订单列表Mapper类.
 */
class OrderInfoMapper extends AbstractMapper
{
    /**
     * @var OrderInfo
     */
    public $model;

    public function assignModel()
    {
        $this->model = OrderInfo::class;
    }

    /**
     * 搜索处理器.
     */
    public function handleSearch(Builder $query, array $params): Builder
    {
        // 订单ID
        if (isset($params['id']) && filled($params['id'])) {
            $query->where('id', '=', $params['id']);
        }

        // 订单编号
        if (isset($params['order_sn']) && filled($params['order_sn'])) {
            $query->where('order_sn', 'like', '%' . $params['order_sn'] . '%');
        }

        // 总金额
        if (isset($params['order_price']) && filled($params['order_price'])) {
            $query->where('order_price', '=', $params['order_price']);
        }

        // 优惠金额
        if (isset($params['order_discount_price']) && filled($params['order_discount_price'])) {
            $query->where('order_discount_price', '=', $params['order_discount_price']);
        }

        // 运费金额
        if (isset($params['order_freight_price']) && filled($params['order_freight_price'])) {
            $query->where('order_freight_price', '=', $params['order_freight_price']);
        }

        // 支付金额
        if (isset($params['order_pay_price']) && filled($params['order_pay_price'])) {
            $query->where('order_pay_price', '=', $params['order_pay_price']);
        }

        // 支付时间
        if (isset($params['order_pay_time']) && filled($params['order_pay_time']) && is_array($params['order_pay_time']) && count($params['order_pay_time']) == 2) {
            $query->whereBetween(
                'order_pay_time',
                [$params['order_pay_time'][0], $params['order_pay_time'][1]]
            );
        }

        // 关闭时间
        if (isset($params['order_close_time']) && filled($params['order_close_time']) && is_array($params['order_close_time']) && count($params['order_close_time']) == 2) {
            $query->whereBetween(
                'order_close_time',
                [$params['order_close_time'][0], $params['order_close_time'][1]]
            );
        }

        // 用户ID
        if (isset($params['order_user_id']) && filled($params['order_user_id'])) {
            $query->where('order_user_id', '=', $params['order_user_id']);
        }

        // 订单类型
        if (isset($params['order_type']) && filled($params['order_type'])) {
            $query->where('order_type', '=', $params['order_type']);
        }

        // 订单状态
        if (isset($params['order_status']) && filled($params['order_status'])) {
            $query->where('order_status', '=', $params['order_status']);
        }

        // 支付状态
        if (isset($params['order_pay_status']) && filled($params['order_pay_status'])) {
            $query->where('order_pay_status', '=', $params['order_pay_status']);
        }

        // 退款状态
        if (isset($params['order_refund_status']) && filled($params['order_refund_status'])) {
            $query->where('order_refund_status', '=', $params['order_refund_status']);
        }

        // 退款类型
        if (isset($params['order_refund_type']) && filled($params['order_refund_type'])) {
            $query->where('order_refund_type', '=', $params['order_refund_type']);
        }

        // 支付方式
        if (isset($params['order_pay_type']) && filled($params['order_pay_type'])) {
            $query->where('order_pay_type', '=', $params['order_pay_type']);
        }

        // 支付源
        if (isset($params['order_pay_source']) && filled($params['order_pay_source'])) {
            $query->where('order_pay_source', '=', $params['order_pay_source']);
        }

        // 订单备注）
        if (isset($params['order_remark']) && filled($params['order_remark'])) {
            $query->where('order_remark', '=', $params['order_remark']);
        }

        // 创建时间
        if (isset($params['created_at']) && filled($params['created_at']) && is_array($params['created_at']) && count($params['created_at']) == 2) {
            $query->whereBetween(
                'created_at',
                [$params['created_at'][0], $params['created_at'][1]]
            );
        }

        // 更新时间
        if (isset($params['updated_at']) && filled($params['updated_at']) && is_array($params['updated_at']) && count($params['updated_at']) == 2) {
            $query->whereBetween(
                'updated_at',
                [$params['updated_at'][0], $params['updated_at'][1]]
            );
        }

        // 删除时间
        if (isset($params['deleted_at']) && filled($params['deleted_at']) && is_array($params['deleted_at']) && count($params['deleted_at']) == 2) {
            $query->whereBetween(
                'deleted_at',
                [$params['deleted_at'][0], $params['deleted_at'][1]]
            );
        }

        return $query;
    }
}
