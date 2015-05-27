<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;

function GetEntityManager() {
    

    $namespaces = array(
    __DIR__ . '\yml' => 'models\entities',
  );

    $config = new Configuration;
    $driverImpl = new SimplifiedYamlDriver($namespaces);
    $config->setMetadataDriverImpl($driverImpl);
    $config->setProxyDir('\xampp\tmp');
    $config->setProxyNamespace('app\config\Proxies');

    // the connection configuration
    $dbParams = array(
        'driver' => 'pdo_mysql',
        'user' => 'twitterClient',
        'password' => 'root',
        'dbname' => 'twitterClient',
        'host' => 'localhost',
    );

    return EntityManager::create($dbParams, $config);
}