<?php

namespace ZendTest\Expressive\Template\TestAsset;

use Zend\Expressive\Template\DefaultParamsTrait;

class DefaultParameters
{
    use DefaultParamsTrait;

    public function getParameters()
    {
        return $this->defaultParams;
    }

    public function mergeParameters($template, array $params)
    {
        return $this->mergeParams($template, $params);
    }
}
