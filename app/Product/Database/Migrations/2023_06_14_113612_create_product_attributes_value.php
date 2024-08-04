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

class CreateProductAttributesValue extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_attributes_value', function (Blueprint $table) {
            $table->integerIncrements('id')->autoIncrement();
            $table->string('product_no', 32)->index()->comment('商品唯一标识ID');
            $table->foreign('product_no')->references('product_no')->on('product_info')->onDelete('cascade');
            $table->string('attributes_no', 32)->comment('商品属性名称编号');
            $table->bigInteger('attr_value_no')->comment('商品属性值编号');
            $table->string('attr_value', 100)->comment('商品属性值');
            $table->comment('产品属性值');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes_value');
    }
}
