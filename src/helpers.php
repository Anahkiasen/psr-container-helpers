<?php

namespace PsrContainerHelpers;

if (!\defined('container')) {
    /**
     * @param string|null $service
     *
     * @return mixed|\Psr\Container\ContainerInterface
     */
    function container(string $service = null)
    {
        return $service ? HelpersManager::$container->get($service) : HelpersManager::$container;
    }
}
