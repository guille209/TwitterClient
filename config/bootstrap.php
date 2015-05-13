<?php
/*
 * 
 * Todooo lo de doctrine
 * 
 */
 
require_once '../vendor/autoload.php';
require_once 'config.php';
 
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
 
$path = array("yml");
$isDevMode = false;
 
$config = Setup::createYAMLMetadataConfiguration($path, $isDevMode);
/*
$config = new \Doctrine\ORM\Configuration();
$route = dirname(__DIR__);

$driverImpl = $config->newDefaultAnnotationDriver(array($route.DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR."entities"));
$config->setMetadataDriverImpl($driverImpl);

$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');
*/
$entityManager = EntityManager::create($dbParams, $config);