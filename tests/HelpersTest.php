<?php

namespace PsrContainerHelpers;

use League\Container\Container;
use Psr\Container\ContainerInterface;

class HelpersTest extends TestCase
{
    protected function setUp()
    {
        $container = new Container();
        $container->share(ContainerInterface::class, $container);

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
}
