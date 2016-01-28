# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.0.3 - 2016-01-28

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#5](https://github.com/zendframework/zend-expressive-template/pull/5)
  actually removes zend-stdlib from the dependency list, which was intended with
  [#4](https://github.com/zendframework/zend-expressive-template/pull/4).

## 1.0.2 - 2016-01-25

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- [#4](https://github.com/zendframework/zend-expressive-template/pull/4) removes
  the dependency on zend-stdlib by inlining the `ArrayUtils::merge(`) routine as a
  private method of `Zend\Expressive\Template\DefaultParamsTrait`.

### Fixed

- Nothing.

## 1.0.1 - 2015-12-02

### Added

- [#1](https://github.com/zendframework/zend-expressive-template/pull/1) imports
  the `RenderingException` class from zend-expressive, pushing it into the
  `Zend\Expressive\Template\Exception` namespace.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.0.0 - 2015-12-02

First stable release.

See the [Expressive CHANGELOG](https://github.com/zendframework/zend-expressive/blob/master/CHANGELOG.md]
for a history of changes prior to 1.0.
