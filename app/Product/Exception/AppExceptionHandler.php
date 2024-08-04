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

namespace App\Product\Exception;

use GuzzleHttp\Exception\ConnectException;
use Hyperf\Codec\Json;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\Logger\Logger;
use Hyperf\Logger\LoggerFactory;
use Mine\Annotation\DependProxy;
use Mine\Log\RequestIdHolder;
use Psr\Http\Message\ResponseInterface;

/**
 * Class AppExceptionHandler.
 */
#[DependProxy(values: [\Mine\Exception\Handler\AppExceptionHandler::class])]
class AppExceptionHandler extends ExceptionHandler
{
    protected Logger $logger;

    protected StdoutLoggerInterface $console;

    public function __construct()
    {
        $this->console = console();
        $this->logger = container()->get(LoggerFactory::class)->get('mineAdmin');
    }

    public function handle(\Throwable $throwable, ResponseInterface $response): ResponseInterface
    {
        $this->console->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));

        $format = [
            'requestId' => RequestIdHolder::getId(),
            'success' => false,
            'code' => 500,
            'message' => $throwable->getMessage(),
        ];

        if ($throwable instanceof ConnectException) {
            $format['message'] = '服务请求错误';
        }

        return $response->withHeader('Server', 'MineAdmin')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'accept-language,authorization,lang,uid,token,Keep-Alive,User-Agent,Cache-Control,Content-Type')
            ->withAddedHeader('content-type', 'application/json; charset=utf-8')
            ->withStatus(500)->withBody(new SwooleStream(Json::encode($format)));
    }

    public function isValid(\Throwable $throwable): bool
    {
        return true;
    }
}
