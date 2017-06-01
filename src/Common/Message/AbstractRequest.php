<?php

namespace Easypay\Common\Message;

use RuntimeException;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * 参数
     * @var array
     */
    protected $parameters = [];

    /**
     * 请求返回对象
     * @var ResponseInterface
     */
    protected $response;

    /**
     * 初始化参数
     * @param  array  $parameters 参数
     */
    public function initialize(array $parameters = [])
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = $parameters;

        return $this;
    }

    public function send()
    {
        $data = $this->getData();

        return $this->sendData($data);
    }

    public function getResponse()
    {
        if (null === $this->response) {
            throw new RuntimeException('You must call send() before accessing the Response!');
        }

        return $this->response;
    }

    /**
     * 获取所有参数
     * @return array 返回所有参数
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * 获取参数值
     * @param  string $key 参数名
     * @return mixed       返回参数值
     */
    protected function getParameter($key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    /**
     * 设置参数值
     * @param  string $key      参数名
     * @param  string $value    参数值
     */
    protected function setParameter($key, $value)
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters[$key] = $value;

        return $this;
    }
}
