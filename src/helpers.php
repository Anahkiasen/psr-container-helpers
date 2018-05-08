<?php

namespace PsrContainerHelpers;

use Psr\Cache\CacheItemPoolInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

if (!\function_exists('container')) {
    /**
     * Get the available container instance.
     *
     * @param string|null $service
     *
     * @return ContainerInterface|mixed
     */
    function container(string $service = null)
    {
        return $service === null
            ? HelpersManager::getContainer()
            : HelpersManager::getContainer()->get($service);
    }
}

if (!function_exists('logger')) {
    /**
     * Log a debug message to the logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return \Psr\Log\LoggerInterface|null
     */
    function logger($message = null, array $context = [])
    {
        return $message === null
            ? container(LoggerInterface::class)
            : container(LoggerInterface::class)->debug($message, $context);
    }
}

if (!function_exists('cache')) {
    /**
     * Get / set the specified cache value.
     *
     * If an array is passed, we'll assume you want to put to the cache.
     *
     * @param  dynamic  key|key,default|data,expiration|null
     *
     * @throws \Psr\Cache\InvalidArgumentException
     *
     * @return mixed
     */
    function cache()
    {
        /** @var CacheItemPoolInterface $cache */
        $arguments = func_get_args();
        $cache = container(CacheItemPoolInterface::class);

        switch (count($arguments)) {
            case 0:
                return $cache;

            case 1:
                return $cache->getItem($arguments[0]);

            case 2:
            default:
                return $cache->save($cache->getItem($arguments[0])->set($arguments[1]));
        }
    }
}
