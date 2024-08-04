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

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_goods', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单商品表');
            $table->string('order_item_no', 45)->unique()->comment('订单商品编号');
            $table->string('order_no', 45)->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');

            $table->string('name', 150)->comment('订单商品名称');
            $table->string('sku_name', 255)->comment('订单商品sku名称');
            $table->string('image', 255)->comment('订单商品名称');
            $table->string('item_no', 100)->comment('订单商品spu编号');
            $table->string('sku_no', 100)->comment('订单商品sku编号');
            $table->integer('num')->default(0)->unsigned()->comment('订单商品购买数量');
            $table->decimal('price')->default(0.00)->comment('订单商品购买价');
            $table->decimal('freight_price')->default(0.00)->comment('订单商品运费');
            $table->decimal('discount_price')->default(0.00)->comment('订单商品优惠金额');
            $table->decimal('pay_price')->default(0.00)->comment('订单商品实付金额');
            $table->enum('is_to_refund', [1, 2])->default(1)->comment('订单商品是否可退货退款（1否2是）');

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index('order_no', 'idx_order_no');
            $table->index('item_no', 'idx_item_no');
            $table->index('sku_no', 'idx_sku_no');
            $table->index(['item_no', 'sku_no'], 'idx_item_no_sku_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_goods');
    }
}
