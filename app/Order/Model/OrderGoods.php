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
 * @property string $order_item_no 订单商品编号
 * @property string $order_no 订单编号
 * @property string $name 订单商品名称
 * @property string $sku_name 订单商品sku名称
 * @property string $image 订单商品名称
 * @property string $item_no 订单商品spu编号
 * @property string $sku_no 订单商品sku编号
 * @property int $num 订单商品购买数量
 * @property string $price 订单商品购买价
 * @property string $freight_price 订单商品运费
 * @property string $discount_price 订单商品优惠金额
 * @property string $pay_price 订单商品实付金额
 * @property string $is_to_refund 订单商品是否可退货退款（1否2是）
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderGoods extends MineModel
{
    public const ITEM_STATUS_ONLINE = 1;

    public const ITEM_STATUS_OFFLINE = 2;

    public const ITEM_STATUS_DELETE = 3;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_goods';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['order_item_no', 'order_no', 'name', 'sku_name', 'image', 'item_no', 'sku_no', 'num', 'price', 'freight_price', 'discount_price', 'pay_price', 'is_to_refund', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['num' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
