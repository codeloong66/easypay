<?php

namespace Easypay\Common\Message;

interface RequestInterface
{
    public function initialize(array $parameters = []);

    public function send();

    public function sendData($data);

    public function getData();

    public function getResponse();
}
