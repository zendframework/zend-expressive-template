<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace ZendTest\Expressive\Template\TestAsset;

class ViewModel
{
    private $variables;

    public function __construct(array $variables)
    {
        $this->variables = $variables;
    }

    public function getVariables()
    {
        return $this->variables;
    }
}
