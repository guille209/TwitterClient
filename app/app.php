<?php

require_once '../vendor/autoload.php';
require_once '../config/twitterConfig.php';
require_once '../config/daoConfig.php';

session_cache_limiter(false);
session_start();

$app = new \Slim\Slim();
$authenticate = function() {
    $app = \Slim\Slim::getInstance();
    return function() use($app) {
        if (!isset($_SESSION['userLogged']) && !isset($_REQUEST['oauth_verifier'])) {
            $app->redirect('/login');
        }
    };
};
$app->get('/login', 'login');
$app->get('/logout', 'logout');
$app->get('/', $authenticate(), 'home');
$app->get('/home', $authenticate(), 'home');
$app->post('/tweet/nearby', $authenticate(), 'nearbyTweets');
$app->get('/user/profile', $authenticate(), 'showProfile');
$app->post('/tweet/search', $authenticate(), 'search');
$app->post('/tweet/create', $authenticate(), 'createTweet');
$app->post('/tweet/destroy', $authenticate(), 'destroyTweet');
$app->post('/tweet/reply', $authenticate(), 'replyTweet');
$app->post('/tweet/retweet', $authenticate(), 'retweet');
$app->post('/user/follow', $authenticate(), 'follow');
$app->post('/user/unfollow', $authenticate(), 'unfollow');
$app->post('/hashtaglist/create', $authenticate(), 'createHashtaglist');
$app->post('/hashtaglist/delete', $authenticate(), 'deleteHashtaglist');
$app->post('/hashtaglist/detail', $authenticate(), 'showHashtaglistDetails');
$app->get('/hashtaglist/list', $authenticate(), 'showHashtaglists');


function login() {
    $logInController = new controllers\registerController();
    $response = $logInController->login();
    echo $response;
}

function logout() {
    $logInController = new controllers\registerController();
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
        $tweetController->toTweet($post_array['tweet']);
    } else {
        $tweetController->programTweet($post_array['tweet'], $post_array['time']);
    }
}

function destroyTweet() {
    $tweetController = new controllers\tweetController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    echo $tweetController->destroyTweet($post_array['id_tweet']);
    $app = \Slim\Slim::getInstance();
    $app->redirect('/home');
}

function replyTweet() {
    $tweetController = new controllers\tweetController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    if (isset($post_array['in_reply_to_status_id']) && isset($post_array['screen_name']) && isset($post_array['tweet'])) {
        $tweetController->replyTweet($post_array['screen_name'], $post_array['tweet'], $post_array['in_reply_to_status_id']);
    }else{
            $app->redirect('/home');
    }
}

function nearbyTweets() {
    $searchController = new controllers\searchController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $latitud = $post_array['latitud'];
    $longitud = $post_array['longitud'];
    $response = $searchController->searchNearbyTweets($latitud, $longitud);
    echo $response;
}

function retweet() {
    $tweetController = new controllers\tweetController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $id_tweet = $post_array['id_tweet'];
    $tweetController->retweet($id_tweet);
}


function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}

function follow() {
    $userController = new controllers\userController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $screen_name = $post_array['screen_name'];
    $response = $userController->follow($screen_name);
    $app = \Slim\Slim::getInstance();
    echo $response;
}

function unfollow() {
    $userController = new controllers\userController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $screen_name = $post_array['screen_name'];
    $response = $userController->unfollow($screen_name);
    $app = \Slim\Slim::getInstance();
    echo $response;
}

function createHashtaglist() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $h = $post_array['hashtag'];
    $response = $hashtagController->createHashtaglist($h);
    $app = \Slim\Slim::getInstance();
    $app->redirect('/hashtaglist/list');
}

function deleteHashtaglist() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $hashtagId = $post_array['hashtagId'];
    $hashtagController->deleteHashtaglist($hashtagId);
    $app->redirect('/home');
}

function showHashtaglistDetails() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $h = $post_array['hashtag'];
    $response = $hashtagController->showHashtaglistDetails($h);
    echo $response;
}

function showHashtaglists() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $response = $hashtagController->showHashtaglists();
    echo $response;
}