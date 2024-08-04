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

namespace Plugin\Wechat\Handler;

use EasyWeChat\MiniApp\Application;
use Hyperf\Context\ApplicationContext;
use Hyperf\HttpServer\Contract\RequestInterface;
use Plugin\Wechat\Construct\AbstractWechat;
use Plugin\Wechat\Interfaces\MiniAppInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\SimpleCache\CacheInterface;

class MiniAppAppHandler extends AbstractWechat implements MiniAppInterface
{
    /**
     * 获取授权登陆.
     */
    public function performSilentLogin(string $code, string $encryptedData, string $iv): array
    {
        $utils = $this->app->getUtils();

        $session = $utils->codeToSession($code);

        return $utils->decryptSession($session['session_key'], $iv, $encryptedData);
    }

    /**
     * 获取手机号码.
     */
    public function getPhoneNumber(string $code): array
    {
        return $this->getClient()->postJson('/wxa/business/getuserphonenumber', ['code' => $code])->toArray();
    }

    /**
     * 静默授权.
     */
    public function silentAuthorize(string $code): array
    {
        return $this->app->getUtils()->codeToSession($code);
    }

    /**
     * 获取小程序码(有限制).
     * @param string $page 小程序页面路径
     * @param string $scene 场景值，可以是任意字符串
     * @param bool $isLimited 是否使用无限制的小程序码，默认为false
     * @param array $options 配置项
     * @return array|string[]
     */
    public function getLimitedWxaCode(string $page, string $scene, bool $isLimited = false, array $options = []): array
    {
        $url = $isLimited ? '/wxa/getwxacodeunlimit' : '/wxa/getwxacode';
        $params = [
            'path' => $page,
            'width' => 430,
            'scene' => $scene,
            'check_path' => $options['check_path'] ?? false,
            'is_hyaline' => $options['is_hyaline'] ?? false,
            'env_version' => $options['env_version'] ?? 'release',
            'auto_color' => $options['auto_color'] ?? false,
            'line_color' => [
                'r' => $options['line_color']['r'] ?? 0,
                'g' => $options['line_color']['g'] ?? 0,
                'b' => $options['line_color']['b'] ?? 0,
            ],
        ];
        $response = $this->getClient()->postJson($url, $params);

        // 保存小程序码到文件
        $path = $options['save_path'] ?? '/uploadfile/wechat/mini/qrcode/';

        $fileName = BASE_PATH . '/public' . $path . md5($page . $scene) . '.png';

        // 如果请求成功，则保存小程序码到文件
        if ($response->isSuccessful()) {
            // 保存文件
            $response->saveAs($fileName);

            if (file_exists($fileName)) {
                return ['path' => $path . $fileName, 'name' => $fileName, 'msg' => '成功'];
            }

            return ['path' => $path . $fileName, 'msg' => '失败，请检查文件夹是否创建'];
        }

        return ['path' => '', 'msg' => '失败'];
    }

    /**
     * 获取微信短链接.
     */
    public function getMiniShortLink(string $pageUrl, string $pageTitle = '', bool $isPermanent = false): array
    {
        $params = [
            'page_url' => $pageUrl,
            'page_title' => $pageTitle,
            'is_permanent' => $isPermanent,
        ];
        return $this->getClient()->postJson('/wxa/genwxashortlink', $params)->toArray();
    }

    /**
     * 初始化.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function initInstance(): void
    {
        $this->app = make(Application::class, [$this->config]);

        // region 替换请求
        $request = ApplicationContext::getContainer()->get(RequestInterface::class);
        $this->app->setRequest($request);

        // region 替换缓存
        $cache = ApplicationContext::getContainer()->get(CacheInterface::class);
        $this->app->setCache($cache);
    }
}
