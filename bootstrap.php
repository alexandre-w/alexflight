<?php
// bootstrap.php
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// $paths = array("/src/AppBundle/Entity");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'alexflight',
);

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src/AppBundle/Entity"), $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
