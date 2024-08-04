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
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Relations\HasOne;
use Mine\MineModel;

/**
 * @property int $id 自增ID
 * @property string $order_sn 订单编号
 * @property string $order_price 订单总金额
 * @property string $order_discount_price 订单优惠金额
 * @property string $order_freight_price 订单运费金额
 * @property string $order_pay_price 订单实际支付金额
 * @property string $order_pay_time 订单支付时间
 * @property string $order_close_time 订单关闭时间
 * @property int $order_user_id 订单用户ID
 * @property string $order_type 订单类型（1普通订单2团购订单3秒杀订单4其他）
 * @property string $order_status 订单状态（1未支付 2已支付 3用户取消 4系统取消 5待收货 6已收货 7订单完成）
 * @property string $order_pay_status 订单支付状态（1未支付2已支付）
 * @property string $order_refund_status 订单退款状态（1未售后2退货处理中3退货待确认4退款成功5退款失败6退货拒绝7退货完成）
 * @property string $order_refund_type 订单退款类型（1仅全部退款2仅部分退款3仅部分退货退款4仅全部退货退款）
 * @property string $order_pay_type 订单支付方式（1线下2小程序支付3app支付4H5支付5扫码支付6pc支付）
 * @property string $order_pay_source 订单支付源（1非第三方2农行支付3易办事4天满支付5美的支付6微信官方7支付宝官方）
 * @property string $order_remark 订单备注）
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderInfo extends MineModel
{
    public const ORDER_STATUS_UNPAID = 0;

    public const ORDER_STATUS_PAID = 1;

    public const ORDER_STATUS_CANCEL = 2;

    public const ORDER_STATUS_USER_CANCEL = 3;

    public const ORDER_STATUS_WAIT_DELIVERY = 4;

    public const ORDER_STATUS_WAIT_RECEIVE = 5;

    public const ORDER_STATUS_COMPLETE = 6;

    public const ORDER_TYPE_NORMAL = 1;

    public const ORDER_TYPE_GROUP = 2;

    public const ORDER_TYPE_SECKILL = 3;

    public const ORDER_TYPE_OTHER = 4;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_info';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'order_sn', 'order_price', 'order_discount_price', 'order_freight_price', 'order_pay_price', 'order_pay_time', 'order_close_time', 'order_user_id', 'order_type', 'order_status', 'order_pay_status', 'order_refund_status', 'order_refund_type', 'order_pay_type', 'order_pay_source', 'order_remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'order_user_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function address(): HasOne
    {
        return $this->hasOne(OrderAddress::class, 'order_no', 'order_no');
    }

    public function items()
    {
        return $this->hasMany(OrderGoods::class, 'order_no', 'order_no');
    }

    public function logistics()
    {
        return $this->hasMany(OrderLogistic::class, 'order_no', 'order_no')->select(['order_no', 'logistics_no', 'logistics_company', 'goods_no', 'goods_sku_no', 'delivered_time', 'delivered_remark']);
    }

    public function created(Created $event)
    {
        // 订单下单成功事件
        event(new OrderCreateEvent($event));
    }
}
