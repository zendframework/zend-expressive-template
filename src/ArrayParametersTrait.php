<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Zend\Expressive\Template;

use Traversable;

use function get_class;
use function gettype;
use function is_array;
use function is_object;
use function iterator_to_array;
use function method_exists;
use function sprintf;

trait ArrayParametersTrait
{
    /**
     * Cast params to an array, if possible.
     *
     * Casts the provided $params argument to an array, using the following rules:
     *
     * - null values result in an empty array
     * - array values are returned verbatim
     * - zend-view view models return the result of getVariables()
     * - Traversables are cast using iterator_to_array
     * - objects that are not zend-view view models nor traversables are cast
     *   using PHP's type casting
     * - scalar values result in an exception
     *
     * @param mixed $params
     * @throws Exception\InvalidArgumentException for non-array, non-object parameters.
     */
    private function normalizeParams($params) : array
    {
        if (null === $params) {
            return [];
        }

        if (is_array($params)) {
            return $params;
        }

        // Special case for zendframework/zend-view view models.
        // Not using typehinting, so as not to require zend-view as a dependency.
        if (is_object($params) && method_exists($params, 'getVariables')) {
            return $params->getVariables();
        }

        if ($params instanceof Traversable) {
            return iterator_to_array($params);
        }

        if (is_object($params)) {
            return (array) $params;
        }

        throw new Exception\InvalidArgumentException(sprintf(
            '%s template adapter can only handle arrays, Traversables, and objects '
            . 'when rendering; received %s',
            get_class($this),
            gettype($params)
        ));
    }
}
