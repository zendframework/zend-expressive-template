<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-template for the canonical source repository
 * @copyright Copyright (c) 2015-2017 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-template/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Zend\Expressive\Template;

use function array_replace_recursive;

/**
 * Trait for providing default template parameters.
 */
trait DefaultParamsTrait
{
    /**
     * @var array
     */
    private $defaultParams = [];

    /**
     * Add a default parameter to use with a template.
     *
     * Use this method to provide a default parameter to use when a template is
     * rendered. The parameter may be overridden by providing it when calling
     * `render()`, or by calling this method again with a null value.
     *
     * The parameter will be specific to the template name provided. To make
     * the parameter available to any template, pass the TEMPLATE_ALL constant
     * for the template name.
     *
     * If the default parameter existed previously, subsequent invocations with
     * the same template name and parameter name will overwrite.
     *
     * @param string $templateName Name of template to which the param applies;
     *     use TEMPLATE_ALL to apply to all templates.
     * @param string $param Param name.
     * @param mixed $value
     * @throws Exception\InvalidArgumentException
     */
    public function addDefaultParam(string $templateName, string $param, $value) : void
    {
        if (! $templateName) {
            throw new Exception\InvalidArgumentException('$templateName must be a non-empty string');
        }

        if (! $param) {
            throw new Exception\InvalidArgumentException('$param must be a non-empty string');
        }

        if (! isset($this->defaultParams[$templateName])) {
            $this->defaultParams[$templateName] = [];
        }

        $this->defaultParams[$templateName][$param] = $value;
    }

    /**
     * Returns merged global, template-specific and given params
     */
    private function mergeParams(string $template, array $params) : array
    {
        $globalDefaults = $this->defaultParams[TemplateRendererInterface::TEMPLATE_ALL] ?? [];
        $templateDefaults = $this->defaultParams[$template] ?? [];

        return array_replace_recursive($globalDefaults, $templateDefaults, $params);
    }
}
