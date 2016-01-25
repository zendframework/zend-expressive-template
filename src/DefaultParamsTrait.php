<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @see       https://github.com/zendframework/zend-expressive for the canonical source repository
 * @copyright Copyright (c) 2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive/blob/master/LICENSE.md New BSD License
 */

namespace Zend\Expressive\Template;

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
     */
    public function addDefaultParam($templateName, $param, $value)
    {
        if (! is_string($templateName) || empty($templateName)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '$templateName must be a non-empty string; received %s',
                (is_object($templateName) ? get_class($templateName) : gettype($templateName))
            ));
        }

        if (! is_string($param) || empty($param)) {
            throw new Exception\InvalidArgumentException(sprintf(
                '$param must be a non-empty string; received %s',
                (is_object($param) ? get_class($param) : gettype($param))
            ));
        }

        if (! isset($this->defaultParams[$templateName])) {
            $this->defaultParams[$templateName] = [];
        }

        $this->defaultParams[$templateName][$param] = $value;
    }

    /**
     * Returns merged global, template-specific and given params
     *
     * @param string $template
     * @param array $params
     * @return array
     */
    private function mergeParams($template, array $params)
    {
        $globalDefaults = isset($this->defaultParams[TemplateRendererInterface::TEMPLATE_ALL])
            ? $this->defaultParams[TemplateRendererInterface::TEMPLATE_ALL]
            : [];

        $templateDefaults = isset($this->defaultParams[$template])
            ? $this->defaultParams[$template]
            : [];

        $defaults = $this->merge($globalDefaults, $templateDefaults);

        return $this->merge($defaults, $params);
    }

    /**
     * Merge array values recursively.
     *
     * Adapted from https://github.com/zendframework/zend-stdlib/commit/26fcc32a358aa08de35625736095cb2fdaced090
     * but removes MergeRemoveKey/MergeReplaceKey functionality, as not
     * relevant to this domain.
     */
    private function merge(array $a, array $b)
    {
        foreach ($b as $key => $value) {
            if (isset($a[$key]) || array_key_exists($key, $a)) {
                if (is_int($key)) {
                    $a[] = $value;
                    continue;
                }

                if (is_array($value) && is_array($a[$key])) {
                    $a[$key] = $this->merge($a[$key], $value);
                    continue;
                }
            }

            $a[$key] = $value;
        }
        return $a;
    }
}
