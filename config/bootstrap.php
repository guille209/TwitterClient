<?php
/*
 * 
 * Todooo lo de doctrine
 * 
 */
 
require_once '../vendor/autoload.php';
 
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
 
$paths = array("/config/yaml");
$isDevMode = false;
 
// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'twitterClient',
    'password' => 'root',
    'dbname'   => 'twitterClient',
    'host'     => 'localhost',
    'port'     => '3307',
);
 
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);