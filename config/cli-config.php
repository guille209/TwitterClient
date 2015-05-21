
<?php

/*
  TIENE QUE SER UN ARCHIVO PEQUEÑO PIDIENDOLO AL BOOTSTRAP EL ENTITYNAMANGER
 */
// (1) Autocargamos clases


use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';


return ConsoleRunner::createHelperSet($em);