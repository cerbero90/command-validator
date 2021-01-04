# Command Validator

[![Author][ico-author]][link-author]
[![PHP Version][ico-php]][link-php]
[![Laravel Version][ico-laravel]][link-laravel]
[![Build Status][ico-actions]][link-actions]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Latest Version][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![PSR-12][ico-psr12]][link-psr12]
[![Total Downloads][ico-downloads]][link-downloads]

[![SensioLabsInsight][ico-sensiolabs]][link-sensiolabs]

Laravel package to validate input in Artisan console commands.

## Install

Via Composer

``` bash
$ composer require cerbero/command-validator
```

## Usage

This package merely consists in the `ValidatesInput` trait that Artisan commands can use to define their own validation rules for arguments and options in the `rules()` method:

``` php
use Illuminate\Console\Command;
use Cerbero\CommandValidator\ValidatesInput;

class SampleCommand extends Command
{
    use ValidatesInput;

    protected function rules()
    {
        return [
            'year' => 'integer|digits:4|min:2000',
            'some_option' => 'string|max:2',
        ];
    }
}
```

The available rules are the same [validation rules][link-rules] provided by Laravel. If you need custom validation, please have a look at [how to define custom rules][link-custom-rules].

Sometimes you may need to show custom messages or attributes for some validation errors. You can achieve that by overriding the methods `messages()` and `attributes()`:

``` php
protected function messages()
{
    return [
        'min' => 'The minimum allowed :attribute is :min'
    ];
}

protected function attributes()
{
    return [
        'year' => 'year of birth'
    ];
}
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

If you discover any security related issues, please email andrea.marco.sartori@gmail.com instead of using the issue tracker.

## Credits

- [Andrea Marco Sartori][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-author]: https://img.shields.io/static/v1?label=author&message=cerbero90&color=50ABF1&logo=twitter&style=flat-square
[ico-php]: https://img.shields.io/packagist/php-v/cerbero/command-validator?color=%234F5B93&logo=php&style=flat-square
[ico-laravel]: https://img.shields.io/static/v1?label=laravel&message=%E2%89%A55.5&color=ff2d20&logo=laravel&style=flat-square
[ico-version]: https://img.shields.io/packagist/v/cerbero/command-validator.svg?label=version&style=flat-square
[ico-actions]: https://img.shields.io/github/workflow/status/cerbero90/command-validator/build?style=flat-square&logo=github
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-psr12]: https://img.shields.io/static/v1?label=compliance&message=PSR-12&color=blue&style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/cerbero90/command-validator.svg?style=flat-square&logo=scrutinizer
[ico-code-quality]: https://img.shields.io/scrutinizer/g/cerbero90/command-validator.svg?style=flat-square&logo=scrutinizer
[ico-downloads]: https://img.shields.io/packagist/dt/cerbero/command-validator.svg?style=flat-square
[ico-sensiolabs]: https://insight.sensiolabs.com/projects/756ebffa-7aa3-464c-a7a4-3f09e37f897a/big.png

[link-author]: https://twitter.com/cerbero90
[link-php]: https://www.php.net
[link-laravel]: https://laravel.com
[link-packagist]: https://packagist.org/packages/cerbero/command-validator
[link-actions]: https://github.com/cerbero90/command-validator/actions?query=workflow%3Abuild
[link-psr12]: https://www.php-fig.org/psr/psr-12/
[link-scrutinizer]: https://scrutinizer-ci.com/g/cerbero90/command-validator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/cerbero90/command-validator
[link-downloads]: https://packagist.org/packages/cerbero/command-validator
[link-author]: https://github.com/cerbero90
[link-contributors]: ../../contributors
[link-sensiolabs]: https://insight.sensiolabs.com/projects/756ebffa-7aa3-464c-a7a4-3f09e37f897a
[link-rules]: https://laravel.com/docs/validation#available-validation-rules
[link-custom-rules]: https://laravel.com/docs/validation#custom-validation-rules
