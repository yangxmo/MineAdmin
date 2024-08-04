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

namespace App\Product\Model;

use Carbon\Carbon;
use Mine\MineModel;

/**
 * @property string $product_no
 * @property string $unit
 * @property int $booked_count
 * @property string $profit
 * @property string $gross_profit
 * @property string $discount
 * @property string $extension
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductAttr extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_attr';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['product_no', 'unit', 'booked_count', 'profit', 'gross_profit', 'discount', 'extension', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['booked_count' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
