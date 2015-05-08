<?php

require '../vendor/autoload.php';
include '/controllers/loginController.php';
include '/controllers/userController.php';
include '/controllers/searchController.php';
include '/controllers/tweetController.php';
include '/controllers/homeController.php';


session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$authenticate = function() {
    $app = \Slim\Slim::getInstance();
    return function() use($app) {
        if (!isset($_SESSION['userLogged']) && !isset($_REQUEST['oauth_verifier'])) {
            echo"Redirecciono a login-..";
            $app->redirect('/login');
        }
    };
};
$app->get('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/', $authenticate(), 'home');
$app->get('/home', $authenticate(), 'home');
$app->get('/user/showProfile', $authenticate(), 'showProfile');
$app->post('/tweet/search', $authenticate(), 'search');
$app->post('/tweet/create', $authenticate(), 'createTweet');
//$app->get('/hashtaglist/create/:name', 'createHashtagList');
//$app->delete('/hashtaglist/delete/:id', 'createHashtagList');
//$app->get('/hashtaglist/list', 'listHastagLists');
//$app->get('/hashtaglist/detail/:id', 'hashtagListDetail');
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
    $homeController = new controllers\homeController();
    $response = $homeController->home();
    echo $response;
}

function search() {
    $searchController = new controllers\searchController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $response = $searchController->search($post_array['criteria']);
    echo $response;
}

function createTweet() {
    $tweetController = new controllers\tweetController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    if (!isset($post_array['schedule'])) {
        echo $tweetController->toTweet($post_array['tweet']);
    } else {
        echo $tweetController->programTweet($post_array['tweet'], $post_array['time']);
    }
}

function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}
