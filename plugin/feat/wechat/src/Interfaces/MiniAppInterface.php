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

namespace Plugin\Wechat\Interfaces;

interface MiniAppInterface
{
    /**
     * 获取微信二维码
     * 本函数用于生成微信小程序二维码，可以根据传入的页面路径、场景值等信息生成对应的二维码图片.
     *
     * @param string $page 小程序页面路径
     * @param string $scene 场景值，可以是任意字符串
     * @param bool $isLimited 是否使用无限制的小程序码，默认为false
     * @param array $options 其他可选参数，如width、height等
     *
     * @return array 返回包含二维码图片的数组
     */
    public function getLimitedWxaCode(string $page, string $scene, bool $isLimited = true, array $options = []): array;

    /**
     * 获取微信短链接
     * 本函数用于将指定的页面链接转换为微信内的短链接，方便在微信环境中分享.
     *
     * @param string $pageUrl 需要转换的页面链接
     * @param string $pageTitle 页面标题，默认为空字符串
     * @param bool $isPermanent 是否生成永久短链接，默认为false
     *
     * @return array 返回包含短链接信息的数组
     */
    public function getMiniShortLink(string $pageUrl, string $pageTitle = '', bool $isPermanent = false): array;

    /**
     * 获取授权登陆.
     *
     * 该方法用于处理小程序端发起的静默授权登录请求. 它接收微信返回的授权代码、加密数据和初始化向量，
     * 并通过这些数据在服务器端验证用户身份并完成登录流程.
     *
     * @param string $code 授权登录的code，用于换取session_key和openid
     * @param string $encryptedData 加密的数据，包含用户信息
     * @param string $iv 加密数据的初始向量
     *
     * @return array 返回处理结果数组
     */
    public function performSilentLogin(string $code, string $encryptedData, string $iv): array;

    /**
     * 获取手机号码.
     *
     * 该方法用于解析和验证从小程序端获取的用户手机号码. 它使用微信登录机制中的code来换取用户的手机号码.
     *
     * @param string $code 用于获取用户手机号的code
     *
     * @return array 返回包含手机号码信息的结果数组
     */
    public function getPhoneNumber(string $code): array;

    /**
     * 静默授权.
     *
     * 该方法用于处理小程序端发起的静默授权请求. 它接收微信返回的授权代码，
     * 并通过这个代码在服务器端验证用户身份并获取相应的授权信息.
     *
     * @param string $code 授权登录的code，用于换取session_key和openid
     *
     * @return array 返回处理结果数组
     */
    public function silentAuthorize(string $code): array;
}
