# mezzio-console Console

_Symfony Console for Mezzio_

[![Docs Status](https://github.com/xtreamwayz/mezzio-console/workflows/build-docs/badge.svg)](https://github.com/xtreamwayz/mezzio-console/actions)
[![Build Status](https://github.com/xtreamwayz/mezzio-console/workflows/qa-tests/badge.svg)](https://github.com/xtreamwayz/mezzio-console/actions)
[![Downloads](https://img.shields.io/packagist/dt/xtreamwayz/mezzio-console.svg)](https://packagist.org/packages/xtreamwayz/mezzio-console)
[![Packagist](https://img.shields.io/packagist/v/xtreamwayz/mezzio-console.svg)](https://packagist.org/packages/xtreamwayz/mezzio-console)

This packages brings [Symfony Console](https://github.com/symfony/console) to your
[Mezzio](https://github.com/mezzio/mezzio) project. It uses the `FactoryCommandLoader` for lazy loading
dependencies. The `FactoryCommandLoader` does almost a good job: It only loads the one command that is
required. But if no command is requested, it still initializes all commands to get the descriptions for
each command. This is fixed by using a `LazyLoadingCommand`. With a bit of reflection and magic it grabs
the configuration from the original command while preventing the command from executing. This way you end
with a list of all commands and their descriptions.

## Installation

```bash
$ composer require xtreamwayz/mezzio-console
```

## Configuration

```php
<?php

declare(strict_types=1);

namespace App;

return [
    'dependencies' => [
        'factories' => [
            Console\MyCommand::class      => Console\MyCommandFactory::class,
            Console\AnotherCommand::class => Console\AnotherCommandFactory::class,
        ],
    ],

    'console' => [
        'commands' => [
            'my:command'      => Console\MyCommand::class,
            'another:command' => Console\AnotherCommand::class,
        ],
    ],
];
```

## Documentation

All project documentation is located in the [./docs](./docs) folder. If you would like to contribute
to the documentation, please submit a pull request. You can read the docs online:
https://xtreamwayz.netlify.app/mezzio-console/

## Contributing

**_BEFORE you start work on a feature or fix_**, please read & follow the
[contributing guidelines](https://github.com/xtreamwayz/.github/blob/master/CONTRIBUTING.md#contributing)
to help avoid any wasted or duplicate effort.

## Copyright and license

Code released under the [MIT License](https://github.com/xtreamwayz/.github/blob/master/LICENSE.md).
Documentation distributed under [CC BY 4.0](https://creativecommons.org/licenses/by/4.0/).
