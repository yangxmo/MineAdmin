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

class CreateOrderPayRecordTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_pay_record', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单支付记录表');
            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');

            $table->string('pay_trade_no', 255)->comment('支付交易号');
            $table->decimal('pay_price')->comment('支付金额');
            $table->tinyInteger('pay_type')->default(1)->unsigned()->comment('订单支付方式（1微信支付2支付宝3线下支付4农行支付5余额支付6微信App支付7积分支付8公众号扫码支付9微信H5支付10支付宝网页11支付宝扫码12易办事微信小程序13易办事微信app支付14易办事公众号扫码支付15易办事公众号js支付）');
            $table->tinyInteger('pay_status')->default(1)->unsigned()->comment('订单支付状态（1成功2失败）');
            $table->addColumn('string', 'remark', ['length' => 255, 'comment' => '支付备注'])->nullable();

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index(['order_no'], 'idx_order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pay_record');
    }
}
