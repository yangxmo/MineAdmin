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

class CreateProductBrand extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_brand', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement()->comment('自增ID');
            $table->string('plat_no', 32)->index()->comment('第三方唯一标识');
            $table->string('brand_no', 10)->index()->unique()->comment('唯一编码');
            $table->string('name', 15)->comment('品牌名称');
            $table->string('image', 255)->nullable()->comment('品牌图片');
            $table->tinyInteger('status')->default(1)->comment('品牌状态(1可用2不可用)');
            $table->integer('sort')->default(0)->comment('排序');

            // 商品创建时间
            $table->datetimes();
            $table->dateTime('deleted_at')->nullable();

            $table->index('plat_no', 'idx_plat_no');
            $table->index('brand_no', 'idx_brand_no');

            $table->comment('商品品牌表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('product_brand');
    }
}
