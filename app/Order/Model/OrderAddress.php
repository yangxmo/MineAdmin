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
 * @property string $receive_user_name 收货人姓名
 * @property string $receive_user_mobile 收货人手机号
 * @property string $receive_user_address 收货人详细地址
 * @property string $receive_user_province 收货人省
 * @property string $receive_user_city 收货人市
 * @property string $receive_user_area 收货人区
 * @property string $receive_user_street 收货人街道
 * @property Carbon $created_at 创建时间
 * @property Carbon $updated_at 更新时间
 * @property string $deleted_at 删除时间
 */
class OrderAddress extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'order_address';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['order_no', 'receive_user_name', 'receive_user_mobile', 'receive_user_address', 'receive_user_province', 'receive_user_city', 'receive_user_area', 'receive_user_street', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['created_at' => 'datetime', 'updated_at' => 'datetime'];
}
