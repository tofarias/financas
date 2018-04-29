<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Fin\Auth\Auth;
use Fin\Auth\JasnyAuth;
use Fin\Repository\RepositoryFactory;
use Fin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Container\ContainerInterface;

class AuthPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('jasny.auth', function(ContainerInterface $container) {
            return new JasnyAuth($container->get('user.repository'));
        });

        $container->addLazy('auth', function(ContainerInterface $container) {
            return new Auth($container->get('jasny.auth'));
        });
    }
}