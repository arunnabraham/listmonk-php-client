<?php

declare(strict_types=1);

namespace Neoxenos\ListMonkClient\Initiate;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class Bootstrap {

    public function diLoader(): Container
    {
        $container = new ContainerBuilder();
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../../config')
        );
        $loader->load('config.yml');

        return $container;
    }
}