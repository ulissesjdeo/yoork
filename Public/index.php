<?php

# Requiring autoload class
require_once('../Core/Autoload.php');

# Instancing autoload (now autoload is working)
$autoload = new Core\Autoload();
$autoload->start();

# Instancing configuration setter
$setter = new Core\Configuration\Setter();
$setter->configure();

# Instancing and running routes
$routes = new App\Routes();
$routes->run();