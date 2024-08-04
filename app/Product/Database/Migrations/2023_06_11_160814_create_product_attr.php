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

class CreateProductAttr extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_attr', function (Blueprint $table) {
            $table->string('product_no', 32)->index()->comment('商品唯一标识ID');
            $table->foreign('product_no')->references('product_no')->on('product_info')->onDelete('cascade');

            $table->string('unit', 10)->default('')->comment('商品单位');
            $table->bigInteger('booked_count')->default(0)->comment('成交量');
            $table->decimal('profit', 7, 2)->default(0.00)->comment('利润率');
            $table->decimal('gross_profit', 7, 2)->default(0.00)->comment('毛利率');
            $table->decimal('discount', 7, 2)->default(0.00)->comment('折扣');
            $table->json('extension')->nullable()->comment('产品附属其他数据');

            $table->index(['product_no'], 'idx_product_no');

            $table->comment('商品其他属性表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attr');
    }
}
