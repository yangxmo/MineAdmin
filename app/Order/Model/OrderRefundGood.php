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
 * @property string $refund_order_no 退款单号
 * @property string $refund_goods_name 退款商品名称
 * @property string $refund_goods_image 退款商品图片
 * @property string $refund_goods_no 退款商品编号
 * @property string $refund_goods_sku_no 退款商品sku编号
 * @property int $refund_goods_num 退款商品数量
 * @property string $refund_goods_old_price 退款商品原价
 * @property string $refund_goods_price 退款商品价格
 * @property string $refund_remark 退款商品备注
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderRefundGood extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_refund_goods';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'order_no', 'refund_order_no', 'refund_goods_name', 'refund_goods_image', 'refund_goods_no', 'refund_goods_sku_no', 'refund_goods_num', 'refund_goods_old_price', 'refund_goods_price', 'refund_remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'refund_goods_num' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
