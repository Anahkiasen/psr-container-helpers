<?php

namespace PsrContainerHelpers;

use League\Container\Container;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class HelpersTest extends TestCase
{
    protected function setUp()
    {
        $container = new Container();
        $container->share(ContainerInterface::class, $container);
        $container->share(LoggerInterface::class, new NullLogger());
        $container->share(CacheItemPoolInterface::class, $this->prophesize(CacheItemPoolInterface::class)->reveal());

        HelpersManager::setContainer($container);
    }

    public function testCanGetContainerFromHelper()
    {
        $this->assertInstanceOf(ContainerInterface::class, container());
    }

    public function testCanGetServiceFromContainer()
    {
        $this->assertInstanceOf(
            ContainerInterface::class,
            container(ContainerInterface::class)
        );
    }

    public function testCanGetLogger()
    {
        $this->assertInstanceOf(
            LoggerInterface::class,
            logger()
        );
    }

    public function testCanLogSomething()
    {
        $logger = $this->prophesize(LoggerInterface::class);
        $logger->debug('foobar', [])->shouldBeCalled();

        container()->share(LoggerInterface::class, $logger->reveal());
        logger('foobar');
    }

    public function testCanGetCache()
    {
        $this->assertInstanceOf(
            CacheItemPoolInterface::class,
            cache()
        );
    }
}
