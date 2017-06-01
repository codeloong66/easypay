<?php

namespace Easypay\Common;

class AbstractGateway implements GatewayInterface
{
    protected $parameters = [];

    public function initialize(array $parameters = [])
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getParameter($key)
    {
        return isset($this->parameters[$key]) ? $this->parameters[$key] : null;
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;

        return $this;
    }

    protected function createRequest($class, array $parameters)
    {
        $request = new $class;

        return $request->initialize(array_replace($this->getParameters(), $parameters));
    }
}
