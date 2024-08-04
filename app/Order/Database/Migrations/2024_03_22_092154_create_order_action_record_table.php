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

class CreateOrderActionRecordTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_action_record', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单操作记录');
            $table->bigIncrements('id')->comment('主键');

            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');
            $table->string('action_type', 20)->comment('操作类型（1创建订单2取消订单3确认收货4申请退款5同意退款6拒绝退款7申请退货8同意退货9拒绝退货10发货11确认收货');
            $table->text('action_params')->nullable()->comment('操作数据');
            $table->string('action_user', 20)->comment('操作人');

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
        Schema::dropIfExists('order_action_record');
    }
}
