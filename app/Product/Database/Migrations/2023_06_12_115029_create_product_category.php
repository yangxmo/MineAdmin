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

class CreateProductCategory extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_category', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('category_no', 10)->unique()->index()->comment('分类唯一标识');
            $table->string('plat_no', 32)->index()->comment('商品第三方唯一标识');
            $table->string('parent_no', 10)->default(0)->comment('上级编码');
            $table->string('brand_no', 10)->default(0)->comment('品牌编码');
            $table->string('title', 30)->default('')->comment('分组名称');
            $table->string('image', 255)->default('')->comment('分组图片');
            $table->bigInteger('feed_count')->default(0)->comment('分组下商品总数');
            $table->tinyInteger('status')->default(1)->comment('分组状态（1可用2不可用）');
            $table->integer('sort')->default(1)->comment('分类排序');
            $table->datetimes();
            $table->datetime('deleted_at')->nullable();

            $table->index('category_no', 'idx_cno');
            $table->index('plat_no', 'idx_plat_no');
            $table->index(['plat_no', 'category_no'], 'idx_plat_cno');
            $table->comment('商品分类');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
}
