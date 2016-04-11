# Command Validator

[![Author][ico-author]][link-author]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![StyleCI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]
[![Gratipay][ico-gratipay]][link-gratipay]

[![SensioLabsInsight][ico-sensiolabs]][link-sensiolabs]

Simple and lightweight package to let your Laravel console commands validate the input they receive.

## Install

From the root of your project run the following command in the terminal:

``` bash
composer require cerbero/command-validator
```

## Usage

Let the commands of which you want to validate input use this package trait and define the `rules()` method:

``` php
use Illuminate\Console\Command;
use Cerbero\CommandValidator\ValidatesInput;

class Example extends Command
{
    use ValidatesInput;

    public function rules()
    {
        return [
            'year' => 'digits:4|min:2000'
        ];
    }
}
```

Both arguments and options can be validated, set their name as keys (no dashes for options) and their rules as values in the array returned by the `rules()` method.

The rules available are the [Laravel default ones](https://laravel.com/docs/5.2/validation#available-validation-rules) and of course you can extend them by specifying [your custom rules](https://laravel.com/docs/5.2/validation#custom-validation-rules).

You may also want to indicate custom messages and attributes for some validation errors, in this case just override the methods `messages()` and `attributes()`:

``` php
public function messages()
{
    return [
        'min' => 'The minimum allowed :attribute is :min'
    ];
}

public function attributes()
{
    return [
        'year' => 'year of birth'
    ];
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email andrea.marco.sartori@gmail.com instead of using the issue tracker.

## Credits

- [Andrea Marco Sartori][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-author]: http://img.shields.io/badge/author-@cerbero90-blue.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/cerbero/command-validator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/cerbero90/command-validator/master.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/cerbero90/command-validator.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/55499793/shield
[ico-downloads]: https://img.shields.io/packagist/dt/cerbero/command-validator.svg?style=flat-square
[ico-gratipay]: https://img.shields.io/gratipay/cerbero.svg?style=flat-square
[ico-sensiolabs]: https://insight.sensiolabs.com/projects/756ebffa-7aa3-464c-a7a4-3f09e37f897a/big.png

[link-author]: https://twitter.com/cerbero90
[link-packagist]: https://packagist.org/packages/cerbero/command-validator
[link-travis]: https://travis-ci.org/cerbero90/command-validator
[link-code-quality]: https://scrutinizer-ci.com/g/cerbero90/command-validator
[link-styleci]: https://styleci.io/repos/55499793
[link-downloads]: https://packagist.org/packages/cerbero/command-validator
[link-gratipay]: https://gratipay.com/cerbero
[link-sensiolabs]: https://insight.sensiolabs.com/projects/756ebffa-7aa3-464c-a7a4-3f09e37f897a
[link-contributors]: ../../contributors
