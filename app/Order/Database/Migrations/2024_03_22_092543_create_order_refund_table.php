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

class CreateOrderRefundTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_refund', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单退货退款表');
            $table->bigIncrements('id')->comment('主键');

            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');
            $table->string('refund_order_no', 45)->unique()->comment('退款编号');
            $table->decimal('refund_price')->default(0.00)->comment('退款金额');
            $table->timestamp('refund_apply_time')->comment('退款申请时间');
            $table->timestamp('refund_time')->nullable()->comment('实际退款时间');
            $table->tinyInteger('refund_status')->unsigned()->default(1)->comment('订单退款状态（1退货处理中2退货待确认3退款成功4退款失败5退货拒绝6退货完成）');
            $table->string('refund_fail_msg', 255)->nullable()->comment('退货退款失败原因');
            $table->tinyInteger('refund_type')->default(1)->comment('订单退款类型（1仅全部退款2仅部分退款3仅部分退货退款4仅全部退货退款）');
            $table->string('refund_remark', 255)->nullable()->comment('退款备注');
            $table->string('refund_address_merchant', 255)->nullable()->comment('退货地址');

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index(['order_no'], 'idx_order_no');
            $table->index(['refund_order_no'], 'idx_refund_order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_refund');
    }
}
