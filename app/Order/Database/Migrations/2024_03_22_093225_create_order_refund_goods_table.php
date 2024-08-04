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

class CreateOrderRefundGoodsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_refund_goods', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单退货退款商品表');
            $table->bigIncrements('id')->comment('主键');

            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');
            $table->string('refund_order_no', 45)->comment('退款单号');
            $table->string('refund_goods_name', 100)->comment('退款商品名称');
            $table->string('refund_goods_image', 255)->default('')->comment('退款商品图片');
            $table->string('refund_goods_no', 50)->comment('退款商品编号');
            $table->string('refund_goods_sku_no', 50)->default('')->comment('退款商品sku编号');
            $table->integer('refund_goods_num')->default(0)->comment('退款商品数量');
            $table->decimal('refund_goods_old_price')->default(0.00)->comment('退款商品原价');
            $table->decimal('refund_goods_price')->default(0.00)->comment('退款商品价格');
            $table->string('refund_remark', 255)->default('')->comment('退款商品备注');

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index(['order_no'], 'idx_order_no');
            $table->index(['refund_order_no'], 'idx_refund_order_no');
            $table->index(['refund_goods_no'], 'idx_refund_goods_no');
            $table->index(['refund_goods_sku_no'], 'idx_refund_goods_sku_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_refund_goods');
    }
}
