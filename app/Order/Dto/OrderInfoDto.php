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

namespace App\Order\Dto;

use Mine\Annotation\ExcelData;
use Mine\Annotation\ExcelProperty;
use Mine\Interfaces\MineModelExcel;

/**
 * 订单列表Dto （导入导出）.
 */
#[ExcelData]
class OrderInfoDto implements MineModelExcel
{
    #[ExcelProperty(value: '订单ID', index: 0)]
    public string $id;

    #[ExcelProperty(value: '订单编号', index: 1)]
    public string $order_sn;

    #[ExcelProperty(value: '总金额', index: 2)]
    public string $order_price;

    #[ExcelProperty(value: '优惠金额', index: 3)]
    public string $order_discount_price;

    #[ExcelProperty(value: '运费金额', index: 4)]
    public string $order_freight_price;

    #[ExcelProperty(value: '支付金额', index: 5)]
    public string $order_pay_price;

    #[ExcelProperty(value: '支付时间', index: 6)]
    public string $order_pay_time;

    #[ExcelProperty(value: '关闭时间', index: 7)]
    public string $order_close_time;

    #[ExcelProperty(value: '用户ID', index: 8)]
    public string $order_user_id;

    #[ExcelProperty(value: '订单类型', index: 9)]
    public string $order_type;

    #[ExcelProperty(value: '订单状态', index: 10)]
    public string $order_status;

    #[ExcelProperty(value: '支付状态', index: 11)]
    public string $order_pay_status;

    #[ExcelProperty(value: '退款状态', index: 12)]
    public string $order_refund_status;

    #[ExcelProperty(value: '退款类型', index: 13)]
    public string $order_refund_type;

    #[ExcelProperty(value: '支付方式', index: 14)]
    public string $order_pay_type;

    #[ExcelProperty(value: '支付源', index: 15)]
    public string $order_pay_source;

    #[ExcelProperty(value: '订单备注）', index: 16)]
    public string $order_remark;

    #[ExcelProperty(value: '创建时间', index: 17)]
    public string $created_at;

    #[ExcelProperty(value: '更新时间', index: 18)]
    public string $updated_at;

    #[ExcelProperty(value: '删除时间', index: 19)]
    public string $deleted_at;
}
