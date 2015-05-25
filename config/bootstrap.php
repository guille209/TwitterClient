<?php

/*
 * 
 * Todo lo de doctrine
 * 
 */

require_once '../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$path = array("yml");
$isDevMode = false;

$dbConfig = array(
    'driver' => 'pdo_mysql',
    'user' => 'twitterClient',
    'password' => 'root',
    'dbname' => 'twitterClient',
    'host' => 'localhost',
);
$config = new Doctrine\ORM\Configuration();

$config = Setup::createYAMLMetadataConfiguration($path, $isDevMode);

$em = EntityManager::create($dbConfig, $config);







/*$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver($path);

$config->setMetadataDriverImpl($driver);

$config->setProxyDir('proxies');
$config->setProxyNamespace('Proxies');
 * 
 * */
 