<?php
declare(strict_types=1);
namespace Fin\Plugins;

use Fin\Models\BillPay;
use Fin\Repository\RepositoryFactory;
use Fin\ServiceContainerInterface;
use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Container\ContainerInterface;
use Fin\Models\BillReceive;

class DbPlugin implements PluginInterface
{
    public function register(ServiceContainerInterface $container)
    {
        $capsule = new Capsule();
        $config = include __DIR__.'/../../config/db.php';
        $capsule->addConnection($config['development']);
        $capsule->bootEloquent();

        $container->add('repository.factory', new RepositoryFactory());

        $container->addLazy('category-cost.repository', function(ContainerInterface $container) {
            return $container->get('repository.factory')->factory(\Fin\Models\CategoryCosts::class);
        });

        $container->addLazy('user.repository', function(ContainerInterface $container) {
            return $container->get('repository.factory')->factory(\Fin\Models\Users::class);
        });

        $container->addLazy('bill-receive.repository', function(ContainerInterface $container) {
            return $container->get('repository.factory')->factory(BillReceive::class);
        });

        $container->addLazy('bill-pay.repository', function(ContainerInterface $container) {
            return $container->get('repository.factory')->factory(BillPay::class);
        });

        //statement.repository
    }
}