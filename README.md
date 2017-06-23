<h1 align="center">IBM Watson PHP SDK</h1>
<p align="center">

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

</p>

---
[Installation](#installation)  
[Usage](#usage)  
[Change Log](#change-log)  
[Testing](#testing)  
[Contributing](#contributing)  
[Security](#security)  
[Credits](#credits)  
[License](#license)  
---

## Install

This library does not impose a specific dependency for sending HTTP requests. Instead we use [HTTPlug](http://httplug.io/) abstraction library to allows to continue using your existing HTTP implementation or use your favoured one.

We also are utilising [PSR-7](http://www.php-fig.org/psr/psr-7/) in this library so you will need to install a `psr-7` compatible library such as [`guzzlehttp/psr7`](https://github.com/guzzle/psr7).

We can do this with a one line composer require:

```
$ composer require php-http/curl-client guzzlehttp/psr7 php-http/message adam-paterson/ibm-watson-sdk
```

## Usage

``` php
$sdk = new IBM\Watson;
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits

- [Adam Paterson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/adam-paterson/ibm-watson-sdk/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/adam-paterson/ibm-watson-sdk.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/adam-paterson/ibm-watson-sdk.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/adam-paterson/ibm-watson-sdk
[link-travis]: https://travis-ci.org/adam-paterson/ibm-watson-sdk
[link-scrutinizer]: https://scrutinizer-ci.com/g/adam-paterson/ibm-watson-sdk/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/adam-paterson/ibm-watson-sdk
[link-downloads]: https://packagist.org/packages/adam-paterson/ibm-watson-sdk
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors