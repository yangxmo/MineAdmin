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
 * @property int $id
 * @property string $parent_no
 * @property string $plat_no
 * @property string $brand_no
 * @property string $name
 * @property string $image
 * @property int $status
 * @property int $sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductBrand extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_brand';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'parent_no', 'plat_no', 'brand_no', 'name', 'image', 'status', 'sort', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
