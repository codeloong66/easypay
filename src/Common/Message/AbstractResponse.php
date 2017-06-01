<?php

namespace Easypay\Common\Message;

abstract class AbstractResponse implements ResponseInterface
{
    protected $request;

    protected $data;

    public function __construct(RequestInterface $request, $data)
    {
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful()
    {
        return false;
    }

    public function isCancelled()
    {
        return false;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getData()
    {
        return $this->data;
    }
}
