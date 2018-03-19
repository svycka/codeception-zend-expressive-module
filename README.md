# codeception-zend-expressive-module

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

**Note:** Replace ```Vytautas Stankus``` ```svycka``` ```https://github.com/svycka``` ```svycka@gmail.com``` ```svycka``` ```codeception-zend-expressive-module``` ```Codeception Module for Zend Expressive 3 Framework``` with their correct values in [README.md](README.md), [CHANGELOG.md](CHANGELOG.md), [CONTRIBUTING.md](CONTRIBUTING.md), [LICENSE.md](LICENSE.md) and [composer.json](composer.json) files, then delete this line. You can run `$ php prefill.php` in the command line to make all replacements at once. Delete the file prefill.php as well.

This module allows you to run tests inside Zend Expressive 3 framework.


## Install

Via Composer

``` bash
$ composer require svycka/codeception-zend-expressive-module
```

## Usage

Put this in your `codeception.yml`
``` yml
modules:
  config:
    \Svycka\Codeception\Module\ZendExpressive:
      container: path/to/container.php
    REST:
      depends: \Svycka\Codeception\Module\ZendExpressive
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email svycka@gmail.com instead of using the issue tracker.

## Credits

- [Vytautas Stankus][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/svycka/codeception-zend-expressive-module.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/svycka/codeception-zend-expressive-module/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/svycka/codeception-zend-expressive-module.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/svycka/codeception-zend-expressive-module.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/svycka/codeception-zend-expressive-module.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/svycka/codeception-zend-expressive-module
[link-travis]: https://travis-ci.org/svycka/codeception-zend-expressive-module
[link-scrutinizer]: https://scrutinizer-ci.com/g/svycka/codeception-zend-expressive-module/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/svycka/codeception-zend-expressive-module
[link-downloads]: https://packagist.org/packages/svycka/codeception-zend-expressive-module
[link-author]: https://github.com/svycka
[link-contributors]: ../../contributors
