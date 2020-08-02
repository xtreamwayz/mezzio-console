<?php

declare(strict_types=1);

namespace XtreamwayzTest\Expressive\Console;

use PHPUnit\Framework\TestCase;
use Xtreamwayz\Expressive\Console\ConfigProvider;

class ConfigProviderTest extends TestCase
{
    /** @var ConfigProvider */
    private $provider;

    public function setUp() : void
    {
        $this->provider = new ConfigProvider();
    }

    public function testInvocationReturnsArray() : array
    {
        $config = ($this->provider)();

        self::assertInternalType('array', $config);

        return $config;
    }

    /**
     * @depends testInvocationReturnsArray
     */
    public function testReturnedArrayContainsDependencies(array $config) : void
    {
        $this->assertArrayHasKey('dependencies', $config);
        $this->assertInternalType('array', $config['dependencies']);
        $this->assertArrayHasKey('factories', $config['dependencies']);
        $this->assertInternalType('array', $config['dependencies']['factories']);

        $this->assertArrayHasKey('console', $config);
        $this->assertInternalType('array', $config['console']);
        $this->assertArrayHasKey('commands', $config['console']);
        $this->assertInternalType('array', $config['console']['commands']);
    }
}
