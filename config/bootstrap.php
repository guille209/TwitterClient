<?php
/*
 * 
 * Todo lo de doctrine
 * 
 */
 
require_once '../vendor/autoload.php';
require_once 'config.php';
 
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
/*
// (2) Configuración
$config = new \Doctrine\ORM\Configuration();

// (3) Caché
$cache = new \Doctrine\Common\Cache\ArrayCache();
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// (4) Driver
$driverImpl = new Doctrine\ORM\Mapping\Driver\YamlDriver('yml');

$config->setMetadataDriverImpl($driverImpl);

// (5) Proxies
$config->setProxyDir(__DIR__ . './Proxies');
$config->setProxyNamespace('Proxies');

// (7) EntityManager
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);


*/







  $path = array("yml");
$isDevMode = false;
 
$config = Setup::createYAMLMetadataConfiguration($path, $isDevMode);


$entityManager = EntityManager::create($dbParams, $config);



/* PRIMERA VERSION MIERDIS
$config->setMetadataDriverImpl(
   new Doctrine\ORM\Mapping\Driver\YmlDriver( 'entity_path' )
);


$config = new \Doctrine\ORM\Configuration();
$route = dirname(__DIR__);

$driverImpl = $config->newDefaultAnnotationDriver(array($route.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."entities"));
$config->setMetadataDriverImpl($driverImpl);

$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
*/