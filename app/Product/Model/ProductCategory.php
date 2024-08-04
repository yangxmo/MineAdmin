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
 * @property string $plat_no
 * @property string $parent_no
 * @property string $brand_no
 * @property string $title
 * @property string $image
 * @property int $feed_count
 * @property int $status
 * @property int $sort
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductCategory extends MineModel
{
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_category';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'parent_no', 'brand_no', 'title', 'image', 'feed_count', 'status', 'sort', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'parent_no' => 'string', 'brand_no' => 'string', 'feed_count' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
