<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Fin\ServiceContainerInterface;

interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}