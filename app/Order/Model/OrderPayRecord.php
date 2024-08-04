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
 * @property string $order_no 订单编号
 * @property string $pay_trade_no 支付交易号
 * @property string $pay_price 支付金额
 * @property int $pay_type 订单支付方式（1微信支付2支付宝3线下支付4农行支付5余额支付6微信App支付7积分支付8公众号扫码支付9微信H5支付10支付宝网页11支付宝扫码12易办事微信小程序13易办事微信app支付14易办事公众号扫码支付15易办事公众号js支付）
 * @property int $pay_status 订单支付状态（1成功2失败）
 * @property string $remark 支付备注
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderPayRecord extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_pay_record';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['order_no', 'pay_trade_no', 'pay_price', 'pay_type', 'pay_status', 'remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['pay_type' => 'integer', 'pay_status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
