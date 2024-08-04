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
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_info', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->comment('商品自增ID');

            // 商品标识
            $table->string('product_no', 32)->index()->unique()->comment('商品唯一标识');

            // 商品名称
            $table->string('name', 150)->comment('商品名称');

            // 商品价格
            $table->decimal('price')->default(0.00)->comment('商品建议销售价');
            $table->decimal('market_price')->default(0.00)->comment('商品市场价');

            // 商品库存（无sku时取这里的库存，有sku时取sku的库存）
            $table->bigInteger('sale')->default(0)->comment('商品库存');

            // 商品图片/视频
            $table->string('image', 255)->nullable()->comment('商品首图');
            $table->json('images')->nullable()->comment('商品轮播图片');
            $table->string('video', 255)->nullable()->comment('商品视频地址');

            // 商品类型
            $table->string('category_no', 10)->default(0)->comment('分组编码');
            $table->string('brand_no', 10)->default(0)->comment('品牌编码');

            $table->tinyInteger('status')->default(1)->comment('商品状态(1上架2下架3删除)');
            $table->text('description')->nullable()->comment('商品详情描述，可包含图片中心的图片URL');

            // 商品上下架时间
            $table->dateTime('on_sale_at')->nullable()->comment('商品上架时间');
            $table->dateTime('off_sale_at')->nullable()->comment('商品下架时间');

            // 商品来源
            $table->tinyInteger('source')->default(1)->comment('商品来源(1拿货2第三方)');

            // 商品创建时间
            $table->datetimes();
            $table->dateTime('deleted_at')->nullable();

            $table->index(['product_no'], 'idx_no');
            $table->index(['category_no'], 'idx_cno');

            $table->comment('商品表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_info');
    }
}
