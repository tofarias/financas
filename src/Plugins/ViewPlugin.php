<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Fin\ServiceContainerInterface;
use Fin\View\ViewRender;
use Interop\Container\Containerinterface;

class ViewPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $container->addLazy('twig', function (Containerinterface $container){
            $loader = new \Twig_Loader_Filesystem(__DIR__.'/../../templates');
            $twig = new \Twig_Environment($loader);
            return $twig;
        });

        $container->addLazy('view.renderer', function(Containerinterface $container){
            $twigEnviroment = $container->get('twig');
            return new ViewRender($twigEnviroment);
        });
    }
}