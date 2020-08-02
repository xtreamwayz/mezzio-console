---
title: Getting started
type: project
layout: page
project: mezzio-console
version: v1
---

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
