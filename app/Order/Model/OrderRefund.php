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

namespace App\Order\Model;

use Carbon\Carbon;
use Mine\MineModel;

/**
 * @property int $id 主键
 * @property string $order_no 订单编号
 * @property string $refund_order_no 退款编号
 * @property string $refund_price 退款金额
 * @property string $refund_apply_time 退款申请时间
 * @property string $refund_time 实际退款时间
 * @property int $refund_status 订单退款状态（1退货处理中2退货待确认3退款成功4退款失败5退货拒绝6退货完成）
 * @property string $refund_fail_msg 退货退款失败原因
 * @property int $refund_type 订单退款类型（1仅全部退款2仅部分退款3仅部分退货退款4仅全部退货退款）
 * @property string $refund_remark 退款备注
 * @property string $refund_address_merchant 退货地址
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderRefund extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_refund';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'order_no', 'refund_order_no', 'refund_price', 'refund_apply_time', 'refund_time', 'refund_status', 'refund_fail_msg', 'refund_type', 'refund_remark', 'refund_address_merchant', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'refund_status' => 'integer', 'refund_type' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
