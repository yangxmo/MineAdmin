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
use Mine\Helper\Id;
use Mine\MineModel;

/**
 * @property int $id 自增ID
 * @property string $brand_no 唯一编码
 * @property string $name 品牌名称
 * @property string $image 品牌图片
 * @property int $status 品牌状态(1可用2不可用)
 * @property int $sort 排序
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductBrand extends MineModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_brand';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'brand_no', 'name', 'image', 'status', 'sort', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function setBrandNoAttribute(string $value)
    {
        $this->attributes['brand_no'] = make(Id::class)->getId();
    }
}
