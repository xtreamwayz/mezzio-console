<?php

declare(strict_types=1);

namespace XtreamLabs\Expressive\Console;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'console'      => $this->getConsole(),
        ];
    }

    public function getDependencies() : array
    {
        return [
            'factories' => [],
        ];
    }

    public function getConsole() : array
    {
        return [
            'commands'      => [],
            'lazy_services' => [],
        ];
    }
}
