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

namespace Plugin\Wechat\Test;

use Hyperf\Di\Annotation\Inject;
use Plugin\Wechat\Interfaces\OfficialAccountInterface;

class OfficialTest
{
    #[Inject]
    protected OfficialAccountInterface $officialAccount;

    /**
     * 获取授权地址.
     */
    public function createAuthorizationUrl(string $redirectUrl = '')
    {
        // 获取授权地址
        $response = $this->officialAccount->createAuthorizationUrl($redirectUrl);

        var_dump($response);
    }

    /**
     * 获取用户信息.
     */
    public function getUserInfo(string $code)
    {
        $response = $this->officialAccount->getUserInfo($code);

        var_dump($response);
    }
}
