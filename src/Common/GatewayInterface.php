<?php

namespace Easypay\Common;

interface GatewayInterface
{
    public function initialize(array $parameters = []);

    public function getParameters();
}
