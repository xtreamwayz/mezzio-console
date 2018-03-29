# Expressive Console

_Symfony Console for Zend Expressive_

[![Build Status](https://travis-ci.org/xtreamlabs/expressive-console.svg)](https://travis-ci.org/xtreamlabs/expressive-console)
[![Packagist](https://img.shields.io/packagist/v/xtreamlabs/expressive-console.svg)](https://packagist.org/packages/xtreamlabs/expressive-console)
[![Packagist](https://img.shields.io/packagist/vpre/xtreamlabs/expressive-console.svg)](https://packagist.org/packages/xtreamlabs/expressive-console)

This packages brings a [Symfony Console](https://github.com/symfony/console) to your Zend Expressive project.

## Installation

    composer require xtreamlabs/expressive-console

## Configuration

```php
<?php

declare(strict_types=1);

namespace App;

use App\Command;

return [
    'dependencies' => [
        'invokables' => [
            Command\MyCommand::class => Command\MyCommandFactory::class,
        ],

        'factories' => [
            Command\AnotherCommand::class => Command\AnotherCommandFactory::class,
        ],
    ],

    'console' => [
        'commands' => [
            // These middleware are added by default
            Command\MyCommand::class,
            Command\AnotherCommand::class,
        ],

        'lazy_services' => [
            // LazyLoad expensive services, requires `ocramius/proxy-manager`
            Doctrine\ORM\EntityManager::class,
        ],
    ]
];
```
