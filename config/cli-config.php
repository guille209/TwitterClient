<?php
// (1) Autocargamos clases
require_once '/vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php';
$classLoader = new DoctrineCommonClassLoader('Doctrine');
$classLoader->register();
$classLoader = new DoctrineCommonClassLoader('Entities', __DIR__);
$classLoader->register();
$classLoader = new DoctrineCommonClassLoader('Proxies', __DIR__);
$classLoader->register();

// (2) Configuración
$config = new DoctrineORMConfiguration();

// (3) Caché
$cache = new DoctrineCommonCacheArrayCache();
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

// (4) Driver
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__."/Entities"));
$config->setMetadataDriverImpl($driverImpl);

// (5) Proxies
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');

// (6) Conexión
$connectionOptions = array(
'driver' => 'pdo_sqlite',
'path' => 'database.sqlite'
);

// (7) EntityManager
$em = DoctrineORMEntityManager::create($connectionOptions, $config);

// (8) HelperSet
$helperSet = new SymfonyComponentConsoleHelperHelperSet(array(
'db' => new DoctrineDBALToolsConsoleHelperConnectionHelper($em->getConnection()),
'em' => new DoctrineORMToolsConsoleHelperEntityManagerHelper($em)
));