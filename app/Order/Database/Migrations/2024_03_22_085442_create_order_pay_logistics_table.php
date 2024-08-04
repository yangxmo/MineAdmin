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

class CreateOrderPayLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_logistics', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单物流表');
            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');

            $table->string('logistics_company', 20)->comment('物流公司名称');
            $table->string('logistics_no', 20)->comment('物流公司单号');
            $table->string('logistics_code', 20)->comment('物流公司编码');
            $table->string('goods_no', 20)->nullable()->comment('商品spu编号');
            $table->string('goods_sku_no', 20)->nullable()->comment('商品sku编号');
            $table->timestamp('delivered_time')->nullable()->comment('发货时间');
            $table->string('delivered_remark', 255)->nullable()->comment('发货备注');
            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_logistics');
    }
}
