<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Zend\Expressive\Template;

class TemplatePath
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var null|string
     */
    protected $namespace;

    public function __construct(string $path, string $namespace = null)
    {
        $this->path      = $path;
        $this->namespace = $namespace;
    }

    /**
     * Casts to string by returning the path only.
     */
    public function __toString() : string
    {
        return $this->path;
    }

    /**
     * Get the namespace
     */
    public function getNamespace() : ?string
    {
        return $this->namespace;
    }

    /**
     * Get the path
     */
    public function getPath() : string
    {
        return $this->path;
    }
}
