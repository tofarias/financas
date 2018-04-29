<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Fin\Auth\Auth;
use Fin\Repository\RepositoryFactory;
use Fin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Container\ContainerInterface;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('auth', function(ContainerInterface $container) {
            return new Auth();
        });
    }
}