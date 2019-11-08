---
title: xtreamwayz/expressive-console
type: project
layout: landingpage
project: expressive-console
---

This packages brings [Symfony Console](https://github.com/symfony/console) to your
[Zend Expressive](https://github.com/zendframework/zend-expressive) project. It uses the `FactoryCommandLoader`
for lazy loading dependencies. The `FactoryCommandLoader` does almost a good job: It only loads the one command
that is required. But if no command is requested, it still initializes all commands to get the descriptions
for each command. This is fixed by using a `LazyLoadingCommand`. With a bit of reflection and magic it grabs
the configuration from the original command while preventing the command from executing. This way you end with
a list of all commands and their descriptions.
