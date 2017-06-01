<?php

namespace Easypay\Yeepay\Message;

use Easypay\Common\Message\AbstractRedirectResponse;

class CardPurchaseResponse extends AbstractRedirectResponse
{
    public function getRedirectUrl()
    {
        return 'http://www.yeeyk.com/yeex-xcard-app/createOrder';
    }

    public function getRedirectTitle()
    {
        return '跳转到易宝支付';
    }

    public function sendData($data)
    {
        $responseData = [];

        return $this->response = new CardPurchaseResponse($this, $responseData);
    }

    public function getData()
    {
    }
}
