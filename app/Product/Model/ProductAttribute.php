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
 * @property string $attributes_name
 */
class ProductAttribute extends MineModel
{
    public bool $timestamps = false;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_attributes';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'product_no', 'attributes_no', 'attributes_name'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer'];

    public function attributeValue()
    {
        return $this->hasMany(ProductAttributesValue::class, 'attributes_no', 'attributes_no');
    }
}
