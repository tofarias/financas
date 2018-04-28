<?php
declare(strict_types=1);
namespace Fin\Plugins;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}