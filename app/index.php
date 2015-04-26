<?php

require '../vendor/autoload.php';
include '/controllers/loginController.php';

session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$app->get('/hello/:name', 'hellodefault');
$app->get('/login', 'login');
$app->get('/home', 'home');
$app->run();

function hellodefault($name) {
    echo "Hello " . $name;
}

function login() {
    $logInController = new controllers\loginController();
    $response = $logInController->login();
    echo $response; 
}

function home() {   
    $logInController = new controllers\loginController();
    $response = $logInController->home();
    echo $response;
}
