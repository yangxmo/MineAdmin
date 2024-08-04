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
use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id
 * @property string $category_no 分类唯一标识
 * @property string $parent_no 上级编码
 * @property string $brand_no 品牌编码
 * @property string $title 分组名称
 * @property string $image 分组图片
 * @property int $feed_count 分组下商品总数
 * @property int $status 分组状态（1可用2不可用）
 * @property int $sort 分类排序
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductCategory extends MineModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_category';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'category_no', 'parent_no', 'brand_no', 'title', 'image', 'feed_count', 'status', 'sort', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'feed_count' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
