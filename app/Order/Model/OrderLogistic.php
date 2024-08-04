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
 * @property string $logistics_name 物流公司名称
 * @property string $logistics_no 物流公司单号
 * @property string $goods_no 商品spu编号
 * @property string $goods_sku_no 商品sku编号
 * @property string $delivered_time 发货时间
 * @property string $delivered_remark 发货备注
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderLogistic extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_logistics';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['order_no', 'logistics_name', 'logistics_no', 'goods_no', 'goods_sku_no', 'delivered_time', 'delivered_remark', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
}
