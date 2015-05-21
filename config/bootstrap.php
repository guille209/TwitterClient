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

$path = array("yml");
$isDevMode = false;

$config = Setup::createYAMLMetadataConfiguration($path, $isDevMode);


$em = EntityManager::create($dbParams, $config);
