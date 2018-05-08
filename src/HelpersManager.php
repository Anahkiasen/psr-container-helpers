<?php

namespace PsrContainerHelpers;

use Psr\Container\ContainerInterface;

class HelpersManager
{
    /**
     * @var ContainerInterface
     */
    public static $container;

    /**
     * @param ContainerInterface $container
     */
    public static function setContainer(ContainerInterface $container): void
    {
        self::$container = $container;
    }
}
