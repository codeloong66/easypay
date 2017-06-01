<?php

namespace Easypay\Common\Message;

/**
 * 响应接口
 */
interface ResponseInterface
{
    /**
     * 请求是否成功
     * @return boolean 如果请求成功则返回 true，反之返回 false
     */
    public function isSuccessful();

    /**
     * 返回是否成功
     * @return boolean 如果返回成功则返回 true，反之返回 false
     */
    public function isCancelled();

    /**
     * 是否需要跳转
     * @return boolean 如果需要跳转则返回 true，反之返回 false
     */
    public function isRedirect();

    /**
     * 获取请求对象
     * @return Request 返回请求对象
     */
    public function getRequest();
}
