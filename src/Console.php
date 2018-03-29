<?php

declare(strict_types=1);

namespace XtreamLabs\Expressive\Console;

use PackageVersions\Versions;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Zend\ServiceManager\Proxy\LazyServiceFactory;
use Zend\ServiceManager\ServiceManager;
use function class_exists;

class Console
{
    /** @var Application */
    private $app;

    public function __construct(Application $app, ContainerInterface $container, array $config)
    {
        $this->app = $app;
        $this->injectLazyServicesIntoContainer($container, $config['lazy_services'] ?? []);
        $this->addCommands($container, $config['commands'] ?? []);
    }

    public static function createFromContainer(ContainerInterface $container) : Console
    {
        $config  = $container->get('config')['console'] ?? [];
        $version = Versions::getVersion('xtreamwayz/expressive-console');

        $app = new Application('Zend Expressive Console', $version);

        return new Console($app, $container, $config);
    }

    /**
     * Runs the current application.
     *
     * @return int 0 if everything went fine, or an error code
     */
    public function run() : int
    {
        return $this->app->run();
    }

    private function injectLazyServicesIntoContainer(ContainerInterface $container, array $lazyServices) : void
    {
        // Skip if we are not dealing with a ServiceManager instance
        if (! $container instanceof ServiceManager) {
            return;
        }

        // Skip if the ProxyManager is not loaded
        if (! class_exists(LazyLoadingValueHolderFactory::class)) {
            return;
        }

        $services = [];
        foreach ($lazyServices as $lazyService) {
            $services['lazy_services']['class_map'][$lazyService] = $lazyService;
            $services['delegators'][$lazyService]                 = [LazyServiceFactory::class];
        }

        /** @var ServiceManager $container */
        $container->configure($services);
    }

    private function addCommands(ContainerInterface $container, array $commands) : void
    {
        foreach ($commands as $command) {
            $this->app->add($container->get($command));
        }
    }
}
