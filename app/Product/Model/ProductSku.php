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

use Mine\MineModel;

/**
 * @property int $id
 * @property string $product_no
 * @property string $attr_value_no
 * @property string $sku_no
 * @property string $name
 * @property string $value
 * @property string $image
 * @property string $video
 * @property int $sale
 * @property string $price
 * @property string $market_price
 * @property int $status
 * @property int $sort
 */
class ProductSku extends MineModel
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_sku';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'product_no', 'attr_value_no', 'sku_no', 'name', 'value', 'image', 'video', 'sale', 'price', 'market_price', 'status', 'sort'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'sale' => 'integer', 'status' => 'integer', 'sort' => 'integer'];
}
