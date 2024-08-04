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

class CreateOrderAddressTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_address', function (Blueprint $table) {
            $table->engine = 'Innodb';
            $table->comment('订单收货地址');
            $table->string('order_no', 45)->index()->comment('订单编号');

            $table->foreign('order_no')->references('order_no')->on('order_info')->onDelete('cascade');

            $table->string('receive_user_name', 20)->comment('收货人姓名');
            $table->string('receive_user_mobile', 15)->comment('收货人手机号');
            $table->string('receive_user_address', 255)->comment('收货人详细地址');

            $table->string('receive_user_province', 20)->comment('收货人省');
            $table->string('receive_user_city', 20)->comment('收货人市');
            $table->string('receive_user_area', 20)->comment('收货人区');
            $table->string('receive_user_street', 20)->comment('收货人街道');

            $table->addColumn('timestamp', 'created_at', ['precision' => 0, 'comment' => '创建时间'])->nullable();
            $table->addColumn('timestamp', 'updated_at', ['precision' => 0, 'comment' => '更新时间'])->nullable();
            $table->addColumn('timestamp', 'deleted_at', ['precision' => 0, 'comment' => '删除时间'])->nullable();

            $table->index(['order_no'], 'idx_order_no');
            $table->index(['receive_user_mobile'], 'idx_receive_user_mobile');
            $table->index(['receive_user_name'], 'idx_receive_user_name');
            $table->index(['order_no', 'receive_user_name'], 'idx_order_receive_user_name');
            $table->index(['order_no', 'receive_user_mobile'], 'idx_order_receive_user_mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_address');
    }
}
