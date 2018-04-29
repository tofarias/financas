<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Aura\Router\RouterContainer;
use Fin\ServiceContainerInterface;
use Psr\Http\Message\RequestInterface;
use Interop\Container\Containerinterface;
use Zend\Diactoros\ServerRequestFactory;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function (Containerinterface $container){
            $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../templates');
            $twig = new \Twig_Environment($loader);
            return $twig;
        });
    }
}