<?php

declare(strict_types=1);

namespace XtreamwayzTest\Mezzio\Console;

use PHPUnit\Framework\TestCase;
use Xtreamwayz\Mezzio\Console\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    /** @var ConfigProvider */
    private $provider;

    public function setUp(): void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray(): array
    {
        $config = ($this->provider)();

        $this->assertIsArray($config);

        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config): void
    {
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertIsArray($config['dependencies']);
        $this->assertArrayHasKey('factories', $config['dependencies']);
        $this->assertIsArray($config['dependencies']['factories']);

        $this->assertArrayHasKey('console', $config);
        $this->assertIsArray($config['console']);
        $this->assertArrayHasKey('commands', $config['console']);
        $this->assertIsArray($config['console']['commands']);
    }
}
