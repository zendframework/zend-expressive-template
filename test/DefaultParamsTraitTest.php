<?php

namespace ZendTest\Expressive\Template;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Expressive\Template\TemplateRendererInterface;
use ZendTest\Expressive\Template\TestAsset\ArrayParameters;
use ZendTest\Expressive\Template\TestAsset\DefaultParameters;

class DefaultParamsTraitTest extends TestCase
{
    /**
     * @var ArrayParameters
     */
    private $arrayParams;

    /**
     * @var DefaultParameters
     */
    private $defaultParams;

    protected function setUp()
    {
        $this->arrayParams   = new ArrayParameters();
        $this->defaultParams = new DefaultParameters();
    }

    public function testDefaultParamArray()
    {
        $foo = [
            1 => ['id' => 1],
            2 => ['id' => 2],
            3 => ['id' => 3],
        ];

        $expected = [
            TemplateRendererInterface::TEMPLATE_ALL => [
                'foo' => $foo,
            ],
        ];

        $this->defaultParams->addDefaultParam(TemplateRendererInterface::TEMPLATE_ALL, 'foo', $foo);
        $this->assertEquals($expected, $this->defaultParams->getParameters());
    }

    public function testMergingParamsWithDefaultParamArray()
    {
        $foo = [
            1 => ['id' => 1],
            2 => ['id' => 2],
            3 => ['id' => 3],
        ];

        $expected = [
            'foo' => [
                1 => ['id' => 1],
                2 => ['id' => 2],
                3 => ['id' => 3],
                4 => ['id' => 4],
            ],
        ];

        // Set default params
        $this->defaultParams->addDefaultParam(TemplateRendererInterface::TEMPLATE_ALL, 'foo', $foo);

        // Mimic renderer
        $params = $this->defaultParams->mergeParameters(
            TemplateRendererInterface::TEMPLATE_ALL,
            $this->arrayParams->normalize([
                'foo' => [
                    3 => ['id' => 3],
                    4 => ['id' => 4],
                ],
            ])
        );
        $params = $this->defaultParams->mergeParameters('template', $params);

        $this->assertEquals($expected, $params);
    }
}
