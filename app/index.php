<?php

require '../vendor/autoload.php';
include '/controllers/loginController.php';
include '/controllers/userController.php';


session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$app->get('/hello/:name', 'hellodefault');
$app->get('/login', 'login');
$app->get('/home', 'home');
$app->get('/showProfile', 'showProfile');
$app->post('/search', 'search');

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

function search() {
    $logInController = new controllers\loginController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $response = $logInController->search($post_array['criteria']);
    echo $response;
}

function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}
