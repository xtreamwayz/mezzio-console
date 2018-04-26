# Expressive Console

_Symfony Console for Zend Expressive_

[![Build Status](https://travis-ci.org/xtreamwayz/expressive-console.svg)](https://travis-ci.org/xtreamwayz/expressive-console)
[![Packagist](https://img.shields.io/packagist/v/xtreamwayz/expressive-console.svg)](https://packagist.org/packages/xtreamwayz/expressive-console)
[![Packagist](https://img.shields.io/packagist/vpre/xtreamwayz/expressive-console.svg)](https://packagist.org/packages/xtreamwayz/expressive-console)

This packages brings a [Symfony Console](https://github.com/symfony/console) to your Zend Expressive project.
It uses the built-in command loader for lazy loading dependencies.

## Installation

    composer require xtreamwayz/expressive-console

## Configuration

```php
<?php

declare(strict_types=1);

namespace App;

return [
    'dependencies' => [
        'factories' => [
            Command\MyCommand::class      => Command\MyCommandFactory::class,
            Command\AnotherCommand::class => Command\AnotherCommandFactory::class,
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
