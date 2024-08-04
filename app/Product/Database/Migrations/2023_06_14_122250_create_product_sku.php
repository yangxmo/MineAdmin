<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

class CreateProductSku extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_sku', function (Blueprint $table) {
            $table->integerIncrements('id')->autoIncrement();
            $table->string('product_no', 32)->index()->comment('商品唯一标识ID');
            $table->foreign('product_no')->references('product_no')->on('product_info')->onDelete('cascade');
            $table->string('attr_no')->comment('商品属性唯一标识');
            $table->string('attr_value_no')->comment('商品属性唯一标识');

            $table->string('sku_no', 50)->comment('商品sku唯一标识');
            // 商品名称
            $table->string('name', 150)->comment('商品sku名称');
            $table->string('value', 150)->comment('sku属性ID所对应的显示名，比如颜色，尺码');

            $table->string('image', 255)->comment('商品sku图片');
            $table->string('video', 255)->default('')->comment('商品sku视频');

            // 价格
            $table->bigInteger('sale')->default(0)->unsigned()->comment('商品sku库存');
            $table->decimal('price')->default(0.00)->comment('商品sku销售价格');
            $table->decimal('market_price')->default(0.00)->comment('商品sku市场价');

            //  商品sku状态
            $table->tinyInteger('status')->default(1)->comment('sku状态(1上架2下架3删除)');
            $table->integer('sort')->default(1)->comment('sku排序');

            $table->index(['product_no', 'sku_no'], 'idx_product_no');

            $table->comment('商品sku表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sku');
    }
}
