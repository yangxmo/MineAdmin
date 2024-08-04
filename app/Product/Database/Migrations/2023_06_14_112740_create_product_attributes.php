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

class CreateProductAttributes extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->integerIncrements('id')->autoIncrement();
            $table->string('product_no', 32)->index()->comment('商品唯一标识ID');
            $table->foreign('product_no')->references('product_no')->on('product_info')->onDelete('cascade');
            $table->string('attributes_no')->comment('商品属性编号');
            $table->string('attributes_name')->comment('商品属性名');

            $table->comment('商品属性表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
}
