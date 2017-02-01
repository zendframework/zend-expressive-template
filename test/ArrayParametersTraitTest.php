<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Expressive\Template;

use ArrayIterator;
use PHPUnit_Framework_TestCase as TestCase;
use stdClass;
use Zend\Expressive\Template\Exception\InvalidArgumentException;

class ArrayParametersTraitTest extends TestCase
{
    public function setUp()
    {
        $this->subject = new TestAsset\ArrayParameters();
    }

    public function testNullParamsAreReturnedAsEmptyArray()
    {
        $this->assertEquals([], $this->subject->normalize(null));
    }

    public function testArrayParamsAreReturnedVerbatim()
    {
        $params = ['foo' => 'bar'];
        $this->assertSame($params, $this->subject->normalize($params));
    }

    public function testExtractsVariablesFromObjectsImplementingGetVariables()
    {
        $params = ['foo' => 'bar'];
        $model  = new TestAsset\ViewModel($params);
        $this->assertSame($params, $this->subject->normalize($model));
    }

    public function testCastsTraversablesToArrays()
    {
        $params = ['foo' => 'bar'];
        $model  = new ArrayIterator($params);
        $this->assertSame($params, $this->subject->normalize($model));
    }

    public function testCastsObjectsToArrays()
    {
        $params = ['foo' => 'bar'];
        $model  = (object) $params;
        $this->assertSame($params, $this->subject->normalize($model));
    }

    public function nonNullScalarParameters()
    {
        // @codingStandardsIgnoreStart
        //                  [scalar,       expected exception string]
        return [
            'true'       => [true,         'bool'],
            'false'      => [false,        'bool'],
            'zero'       => [0,            'int'],
            'int'        => [1,            'int'],
            'zero-float' => [0.0,          'double'],
            'float'      => [1.1,          'double'],
            'string'     => ['view param', 'string'],
        ];
        // @codingStandardsIgnoreEnd
    }

    /**
     * @dataProvider nonNullScalarParameters
     */
    public function testNonNullScalarsRaiseAnException($scalar, $expectedString)
    {
        $this->setExpectedException(InvalidArgumentException::class, $expectedString);
        $this->subject->normalize($scalar);
    }
}
