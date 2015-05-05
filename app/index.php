<?php

require '../vendor/autoload.php';
include '/controllers/loginController.php';
include '/controllers/userController.php';
include '/controllers/searchController.php';

session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$app->get('/login', 'login');
$app->get('/home', 'home');
$app->get('/showProfile', 'showProfile');
$app->post('/search', 'search');

$app->run();

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
    $searchController = new controllers\searchController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $response = $searchController->search($post_array['criteria']);
    echo $response;
//echo json_decode($response, JSON_UNESCAPED_UNICODE);
}

function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}
