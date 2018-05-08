<?php

namespace PsrContainerHelpers;

use League\Container\Container;
use Psr\Container\ContainerInterface;

class HelpersServiceProviderTest extends TestCase
{
    public function testCanUseServiceProvider()
    {
        $container = new Container();
        $container->share(ContainerInterface::class, $container);
        $container->addServiceProvider(new HelpersServiceProvider());

        $service = container(ContainerInterface::class);
        $this->assertInstanceOf(ContainerInterface::class, $service);
    }
}
