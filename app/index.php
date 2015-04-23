<?php

require '../vendor/autoload.php';
$app = new \Slim\Slim();


//$app->get('/', 'hellodefault');

$app->get('/hello/:name', 'hellodefault');

$app->run();

function hellodefault($name) {

    echo "Hello ".$name;
}
