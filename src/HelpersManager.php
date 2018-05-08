<?php

namespace PsrContainerHelpers;

use Psr\Container\ContainerInterface;

class HelpersManager
{
    /**
     * @var ContainerInterface
     */
    protected static $container;

    /**
     * @param ContainerInterface $container
     */
    public static function setContainer(ContainerInterface $container)
    {
        self::$container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public static function getContainer(): ContainerInterface
    {
        return self::$container;
    }
}
