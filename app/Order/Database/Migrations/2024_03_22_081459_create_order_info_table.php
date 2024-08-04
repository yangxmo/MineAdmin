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

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单基础表');
            $table->bigIncrements('id')->comment('自增ID');
            $table->string('order_no', 45)->unique()->comment('订单编号');
            $table->decimal('order_price')->default(0.00)->comment('订单总金额');
            $table->decimal('order_discount_price')->default(0.00)->comment('订单优惠金额');
            $table->decimal('order_freight_price')->default(0.00)->comment('订单运费金额');
            $table->decimal('order_pay_price')->default(0.00)->comment('订单实际支付金额');
            $table->timestamp('order_pay_time')->nullable()->comment('订单支付时间');
            $table->timestamp('order_close_time')->nullable()->comment('订单关闭时间');
            $table->bigInteger('order_user_id')->unsigned()->comment('订单用户ID');
            $table->enum('order_type', [1, 2, 3])->default(1)->comment('订单类型（1普通订单2团购订单3秒杀订单4其他）');
            $table->enum('order_status', [1, 2, 3, 4, 5, 6, 7])->default(1)->comment(
                '订单状态（1未支付 2已支付 3用户取消 4系统取消 5待收货 6已收货 7订单完成）'
            );
            $table->enum('order_pay_status', [1, 2])->default(1)->comment('订单支付状态（1未支付2已支付）');
            $table->enum('order_refund_status', [1, 2, 3, 4, 5, 6, 7])->default(1)->comment(
                '订单退款状态（1未售后2退货处理中3退货待确认4退款成功5退款失败6退货拒绝7退货完成）'
            );
            $table->enum('order_refund_type', [1, 2, 3, 4])->default(1)->comment(
                '订单退款类型（1仅全部退款2仅部分退款3仅部分退货退款4仅全部退货退款）'
            );
            $table->enum('order_pay_type', [1, 2, 3, 4, 5, 6])->default(1)->comment(
                '订单支付方式（1线下2小程序支付3app支付4H5支付5扫码支付6pc支付）'
            );
            $table->enum('order_pay_source', [1, 2, 3])->default(1)->comment(
                '订单支付源（1余额2微信支付3支付宝）'
            );
            $table->text('order_remark')->nullable()->comment('订单备注）');

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index(['order_no'], 'idx_order_no');
            $table->index(['order_pay_time'], 'idx_order_pay_time');
            $table->index(['order_user_id'], 'idx_order_user_id');
            $table->index(['order_type'], 'idx_order_type');
            $table->index(['order_status'], 'idx_order_status');
            $table->index(['order_pay_status'], 'idx_order_pay_status');
            $table->index(['order_refund_status'], 'idx_order_refund_status');
            $table->index(['order_refund_type'], 'idx_order_refund_type');
            $table->index(['order_pay_type'], 'idx_order_pay_type');
            $table->index(['order_user_id', 'order_status'], 'idx_user_order_status');
            $table->index(['order_user_id', 'order_pay_status'], 'idx_user_order_pay_status');
            $table->index(['order_user_id', 'order_refund_status'], 'idx_user_order_refund_status');
            $table->index(['order_user_id', 'order_refund_type'], 'idx_user_order_refund_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_info');
    }
}
