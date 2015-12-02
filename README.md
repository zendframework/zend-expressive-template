# zend-expressive-template

[![Build Status](https://secure.travis-ci.org/zendframework/zend-expressive-template.svg?branch=master)](https://secure.travis-ci.org/zendframework/zend-expressive-template)

Template subcomponent for [Expressive](https://github.com/zendframework/zend-expressive].

This package provides the following classes, interfaces, and traits:

- `TemplateRendererInterface`, a generic interface for providing template
  rendering capabilities.
- `TemplatePath`, a value object describing a (optionally) namespaced path in
  which templates reside; the `TemplateRendererInterface` returns these.
- `ArrayParametersTrait` provides helper methods you can mix in to
  implementations for normalizing template parameters to an array.
- `DefaultParamsTrait` provides helper methods you can mix in to
  implementations for aggregating default parameters as well as merging global,
  template-specific, and provided parameters when rendering.

## Installation

Typically, you will install this when installing Expressive. However, it can be
used standalone to provide a generic way to provide templating to your
application. To do this, use:

```bash
$ composer require zendframework/zend-expressive-template
```

We currently support and provide the following routing integrations:

- [Plates](https://github.com/thephpleague/plates):
  `composer require zendframework/zend-expressive-platesrenderer`
- [Twig](http://twig.sensiolabs.org/):
  `composer require zendframework/zend-expressive-twigrenderer`
- [ZF2 PhpRenderer](https://github.com/zendframework/zend-view):
  `composer require zendframework/zend-expressive-zendviewrenderer`

## Documentation

Expressive provides [template documentation](http://zend-expressive.readthedocs.org/en/latest/template/intro/).
