<?php

use Fin\Application;
use Fin\Plugins\AuthPlugin;
use Fin\Plugins\DbPlugin;
use Fin\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;