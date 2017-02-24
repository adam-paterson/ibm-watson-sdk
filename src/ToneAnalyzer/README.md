# IBM Watson Tone Analyzer

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require adam-paterson/watson-tone-analyzer
```

## Usage

```php
<?php

$toneAnalyzer = new \IBM\Watson\ToneAnalyzer\Service();

// Initialize the service with required parameters
$toneAnalyzer->initialize([
    'username' => '<BLUEMIX_USERNAME>',
    'password' => '<BLUE_MIXPASSWORD>',
]);

$request = $toneAnalyzer->tone([
    'text'     => 'Some text to analyze',
]);

$response = $request->send();
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

If you discover any security related issues, please email hello@adampaterson.co.uk instead of using the issue tracker.

## Credits

- [Adam Paterson][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/adam-paterson/watson-tone-analyzer/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/adam-paterson/watson-tone-analyzer.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/adam-paterson/watson-tone-analyzer.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/adam-paterson/watson-tone-analyzer
[link-travis]: https://travis-ci.org/adam-paterson/watson-tone-analyzer
[link-scrutinizer]: https://scrutinizer-ci.com/g/adam-paterson/watson-tone-analyzer/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/adam-paterson/watson-tone-analyzer
[link-downloads]: https://packagist.org/packages/adam-paterson/watson-tone-analyzer
[link-author]: https://github.com/adam-paterson
[link-contributors]: ../../contributors
