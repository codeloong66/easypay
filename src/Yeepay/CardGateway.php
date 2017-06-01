<?php

namespace Easypay\Yeepay;

use Easypay\Common\AbstractGateway;

class CardGateway extends AbstractGateway
{
    public function purchase(array $parameters = [])
    {
        return $this->createRequest('\Easypay\Yeepay\Message\CardPurchaseRequest', $parameters);
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
}
