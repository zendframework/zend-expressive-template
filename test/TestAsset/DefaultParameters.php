<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

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
