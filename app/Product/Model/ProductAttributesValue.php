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
 * @property string $attributes_no
 * @property int $attr_value_no
 * @property string $attr_value
 */
class ProductAttributesValue extends MineModel
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_attributes_value';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'product_no', 'attributes_no', 'attr_value_no', 'attr_value'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'product_no' => 'string', 'attributes_no' => 'string', 'attr_value_no' => 'string'];

    public function sku()
    {
        return $this->hasMany(ProductSku::class, 'attr_value_no', 'attr_value_no');
    }
}
