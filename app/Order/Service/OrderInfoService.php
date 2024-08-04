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

namespace App\Order\Service;

use App\Order\JsonRpc\RpcServiceOrderInterface;
use App\Order\Mapper\OrderInfoMapper;
use Hyperf\Di\Annotation\Inject;
use Mine\Abstracts\AbstractService;

/**
 * 订单列表服务类.
 */
class OrderInfoService extends AbstractService
{
    /**
     * @var OrderInfoMapper
     */
    public $mapper;

    #[Inject]
    protected RpcServiceOrderInterface $rpcServiceOrder;

    public function __construct(OrderInfoMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * 获取列表数据.
     */
    public function getPageList(?array $params = null, bool $isScope = true): array
    {
        if ($params['select'] ?? null) {
            $params['select'] = explode(',', $params['select']);
        }
        return $this->rpcServiceOrder->getOrderList($params);
    }

    /**
     * 获取订单详情.
     */
    public function getInfo(string $orderNo): array
    {
        return $this->rpcServiceOrder->getOrderInfo($orderNo);
    }
}
