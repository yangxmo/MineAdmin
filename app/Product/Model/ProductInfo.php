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

use App\Product\Event\ProductCreateEvent;
use App\Product\Event\ProductDeleteEvent;
use App\Product\Event\ProductUpdateEvent;
use Carbon\Carbon;
use Hyperf\Database\Model\Events\Created;
use Hyperf\Database\Model\Events\Deleted;
use Hyperf\Database\Model\Events\Updated;
use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\Database\Model\SoftDeletes;
use Mine\MineModel;

/**
 * @property int $id 商品自增ID
 * @property string $product_no 商品唯一标识
 * @property string $name 商品名称
 * @property string $price 商品建议销售价
 * @property string $market_price 商品市场价
 * @property int $sale 商品库存
 * @property string $image 商品首图
 * @property array $images 商品轮播图片
 * @property string $video 商品视频地址
 * @property string $category_no 分组ID
 * @property string $brand_no 品牌ID
 * @property int $status 商品状态(1上架2下架3删除)
 * @property string $description 商品详情描述，可包含图片中心的图片URL
 * @property string $on_sale_at 商品上架时间
 * @property string $off_sale_at 商品下架时间
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $deleted_at
 */
class ProductInfo extends MineModel
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     */
    protected ?string $table = 'product_info';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'product_no', 'name', 'price', 'market_price', 'sale', 'image', 'images', 'video', 'category_no', 'brand_no', 'status', 'description', 'on_sale_at', 'off_sale_at', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'price' => 'decimal:2', 'market_price' => 'decimal:2', 'sale' => 'integer', 'images' => 'array', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function sku(): HasMany
    {
        return $this->hasMany(ProductSku::class, 'product_no', 'product_no')->select(['product_no', 'sku_no', 'name', 'value', 'image', 'price', 'market_price', 'sale', 'sort']);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class, 'product_no', 'product_no')->select(['product_no', 'attributes_no', 'attributes_name']);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_no', 'category_no')->select('category_no', 'title');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(ProductBrand::class, 'brand_no', 'brand_no');
    }

    public function updated(Updated $event): void
    {
        /** @var ProductInfo $model */
        $model = $event->getModel();
        event(new ProductUpdateEvent($model));
    }

    public function deleted(Deleted $event): void
    {
        /** @var ProductInfo $model */
        $model = $event->getModel();
        event(new ProductDeleteEvent($model));
    }

    public function created(Created $event): void
    {
        /** @var ProductInfo $model */
        $model = $event->getModel();
        event(new ProductCreateEvent($model));
    }
}
