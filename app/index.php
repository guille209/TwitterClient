<?php

require '../vendor/autoload.php';
include '/controllers/loginController.php';
include '/controllers/userController.php';
include '/controllers/searchController.php';

session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$app->get('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/', 'home');
$app->get('/home', 'home');
$app->get('/showProfile', 'showProfile');
$app->post('/search', 'search');
$app->get('/hashtaglist/create/:name', 'createHashtagList');
$app->delete('/hashtaglist/delete/:id', 'createHashtagList');
$app->get('/hashtaglist/list', 'listHastagLists');
$app->get('/hashtaglist/detail/:id', 'hashtagListDetail');


$app->run();

function login() {
    $logInController = new controllers\loginController();
    $response = $logInController->login();
    echo $response;
}

function logout() {
    $logInController = new controllers\loginController();
    $response = $logInController->logout();
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
}

function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}
