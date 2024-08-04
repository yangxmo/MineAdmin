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

namespace App\Order\Controller\Manage;

use App\Order\Dto\OrderInfoDto;
use App\Order\Request\OrderInfoRequest;
use App\Order\Service\OrderInfoService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PostMapping;
use Mine\Annotation\Auth;
use Mine\Annotation\OperationLog;
use Mine\Annotation\Permission;
use Mine\Annotation\RemoteState;
use Mine\Middlewares\CheckModuleMiddleware;
use Mine\MineController;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * 订单列表控制器
 * Class OrderInfoController.
 */
#[Controller(prefix: 'order/info'), Auth]
#[Middleware(middleware: CheckModuleMiddleware::class)]
class OrderInfoController extends MineController
{
    /**
     * 业务处理服务
     * OrderInfoService.
     */
    #[Inject]
    protected OrderInfoService $service;

    /**
     * 列表.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('index'), Permission('order:info, order:info:index')]
    public function index(OrderInfoRequest $request): ResponseInterface
    {
        return $this->success($this->service->getPageList($request->validated()));
    }

    /**
     * 读取数据.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[GetMapping('read/{orderNo}'), Permission('order:info:read')]
    public function read(string $orderNo): ResponseInterface
    {
        return $this->success($this->service->getInfo($orderNo));
    }

    /**
     * 数据导出.
     * @throws Exception
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[PostMapping('export'), Permission('order:info:export'), OperationLog]
    public function export(): ResponseInterface
    {
        return $this->service->export($this->request->all(), OrderInfoDto::class, '导出数据列表');
    }

    /**
     * 远程万能通用列表接口.
     */
    #[PostMapping('remote'), RemoteState(true)]
    public function remote(): ResponseInterface
    {
        return $this->success($this->service->getRemoteList($this->request->all()));
    }
}
