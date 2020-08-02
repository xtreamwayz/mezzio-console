<?php

declare(strict_types=1);

namespace XtreamwayzTest\Mezzio\Console;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use Xtreamwayz\Mezzio\Console\Console;
use XtreamwayzTest\Mezzio\Console\Fixtures\ExceptionThrowingCommand;
use XtreamwayzTest\Mezzio\Console\Fixtures\TestCommand;

class ConsoleTest extends TestCase
{
    use ProphecyTrait;

    /** @var ContainerInterface|ObjectProphecy */
    private $container;

    protected function setUp(): void
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    public function testStaticConstruction(): void
    {
        $this->container->get('config')->willReturn([]);

        $console = Console::createFromContainer($this->container->reveal());

        $this->assertInstanceOf(Console::class, $console);
    }

    public function testLazyLoading(): void
    {
        $this->container->get('config')->willReturn([
            'console' => [
                'commands' => [
                    'foo:bar' => ExceptionThrowingCommand::class,
                ],
            ],
        ]);
        $this->container->has(ExceptionThrowingCommand::class)->willReturn(true);
        $this->container->get(ExceptionThrowingCommand::class)->willReturn(new TestCommand('foo:bar'));

        $console = Console::createFromContainer($this->container->reveal());

        $reflectionClass    = new ReflectionClass(Console::class);
        $reflectionProperty = $reflectionClass->getProperty('application');
        $reflectionProperty->setAccessible(true);
        $application = $reflectionProperty->getValue($console);

        $this->assertInstanceOf(Console::class, $console);
        $this->assertTrue($application->has('foo:bar'));
    }
}
