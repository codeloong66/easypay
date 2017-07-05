<?php

namespace Easypay\Yeepay\Message;

use Easypay\Common\Message\AbstractRequest;
use Easypay\Yeepay\Helper;
use Easypay\Yeepay\Message\CardPurchaseResponse;

class CardPurchaseRequest extends AbstractRequest
{
    public function sendData($data)
    {
        $responseData = [];

        return $this->response = new CardPurchaseResponse($this, $responseData);
    }

    public function getData()
    {
        $data = [
            'bizType' => 'STANDARD',
            'merchantNo' => $this->getMerchantNo(),
            'merchantOrderNo' => $this->getMerchantOrderNo(),
            'requestAmount' => $this->getRequestAmount(),
            'url' => $this->getUrl(),
            'cardCode' => 'MOBILE',
            'productName'=> '充值',
            'productType' => '',
            'productDesc' => '',
            'extInfo' => '',
        ];

        $data['hmac'] = Helper::sign($data, $this->getKey());

        return $data;
    }

    public function getKey()
    {
        return $this->getParameter('key');
    }

    public function setKey($value)
    {
        return $this->setParameter('key', $value);
    }

    public function getMerchantNo()
    {
        return $this->getParameter('merchantNo');
    }

    public function setMerchantNo($value)
    {
        return $this->setParameter('merchantNo', $value);
    }

    public function getMerchantOrderNo()
    {
        return $this->getParameter('merchantOrderNo');
    }

    public function setMerchantOrderNo($value)
    {
        return $this->setParameter('merchantOrderNo', $value);
    }

    public function getRequestAmount()
    {
        return $this->getParameter('requestAmount');
    }

    public function setRequestAmount($value)
    {
        return $this->setParameter('requestAmount', $value);
    }

    public function getUrl()
    {
        return $this->getParameter('url');
    }

    public function setUrl($value)
    {
        return $this->setParameter('url', $value);
    }
}
