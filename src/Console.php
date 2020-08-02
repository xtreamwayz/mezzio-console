<?php

declare(strict_types=1);

namespace Xtreamwayz\Mezzio\Console;

use PackageVersions\Versions;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

class Console
{
    /** @var Application */
    private $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    public static function createFromContainer(ContainerInterface $container): self
    {
        // Setup application
        $version     = Versions::getVersion('xtreamwayz/mezzio-console');
        $application = new Application('Mezzio Console', $version);

        // Setup command loader for lazy loading
        $config     = $container->get('config')['console'] ?? [];
        $commands   = $config['commands'] ?? [];
        $commandMap = [];
        foreach ($commands as $name => $class) {
            $commandMap[$name] = function () use ($name, $class, $container) {
                return new LazyLoadingCommand($name, $class, $container);
            };
        }
        $loader = new FactoryCommandLoader($commandMap);
        $application->setCommandLoader($loader);

        return new self($application);
    }

    /**
     * Runs the current application.
     *
     * @return int 0 if everything went fine, or an error code
     */
    public function run(): int
    {
        return $this->application->run();
    }
}
