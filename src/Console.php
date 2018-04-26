<?php

declare(strict_types=1);

namespace Xtreamwayz\Expressive\Console;

use PackageVersions\Versions;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;

class Console
{
    /** @var Application */
    private $application;

    public function __construct(Application $application, ContainerCommandLoader $loader)
    {
        $this->application = $application;
        $this->application->setCommandLoader($loader);
    }

    public static function createFromContainer(ContainerInterface $container) : Console
    {
        // Setup command loader
        $config   = $container->get('config')['console'] ?? [];
        $commands = $config['commands'] ?? [];
        $loader   = new ContainerCommandLoader($container, $commands);

        // Setup console
        $version     = Versions::getVersion('xtreamwayz/expressive-console');
        $application = new Application('Expressive Console', $version);

        return new self($application, $loader);
    }

    /**
     * Runs the current application.
     *
     * @return int 0 if everything went fine, or an error code
     */
    public function run() : int
    {
        return $this->application->run();
    }
}
