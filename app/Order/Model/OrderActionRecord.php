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
 * @property string $action_type 操作类型（1创建订单2取消订单3确认收货4申请退款5同意退款6拒绝退款7申请退货8同意退货9拒绝退货10发货11确认收货
 * @property string $action_params 操作数据
 * @property string $action_user 操作人
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderActionRecord extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_action_record';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'order_no', 'action_type', 'action_params', 'action_user', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
