<?php

require_once '../vendor/autoload.php';
require_once '../config/twitterConfig.php';
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
$app->get('/user/showFriends', $authenticate(), 'showFriends');
$app->post('/hashtaglist/create', $authenticate(), 'createHashtaglist');
$app->post('/hashtaglist/delete', $authenticate(), 'deleteHashtaglist');
$app->get('/hashtaglist/detail', $authenticate(), 'showHashtaglistDetails');
$app->get('/hashtaglist/list', $authenticate(), 'showHashtaglists');

//$app->post('/hashtaglist/createSavedQuery', $authenticate(), 'createSavedQuery');
//$app->get('/hashtaglist/get_saved', $authenticate(), 'get_saved');

/* Acciones autenticacion */
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

/* Pagina principal */

function home() {
    $homeController = new controllers\homeController();
    $response = $homeController->home();
    echo $response;
}

/* Buscar en toda la aplicacion */

function search() {
    $searchController = new controllers\searchController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $response = $searchController->search($post_array['criteria']);
    echo $response;
}

/* Tweets */

function createTweet() {
    $tweetController = new controllers\tweetController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    if (!isset($post_array['schedule'])) {
        $tweetController->toTweet($post_array['tweet']);
    } else {//Tweet programado
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
    } else {
        //codigo de error de parametros
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
    //echo $id_tweet;
    $tweetController->retweet($id_tweet);
}

/* Perfil usuario */

function showProfile() {
    $userController = new controllers\userController();
    $response = $userController->showProfile();
    echo $response;
}

/* Seguimiento usuarios */

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

function showFriends() {
    $userController = new controllers\userController();
    $app = \Slim\Slim::getInstance();
    $response = $userController->showFriends();
    echo $response;
}

/* Hashtaglists */

function createHashtaglist() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $h = $post_array['hashtag'];
    //$h = new models\entities\Hashtaglist();
    //$h->hashtag;
    $response = $hashtagController->createHashtaglist($h);
    //echo $response;
    $app = \Slim\Slim::getInstance();
    $app->redirect('/hashtaglist/showHashtaglistDetails');
}

function deleteHashtaglist() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $hashtagId = $post_array['hashtagId'];
    //$h->hashtag
    $hashtagController->deleteHashtaglist($hashtagId);
    //echo $response;
    $app->redirect('/home');
}

function showHashtaglistDetails() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $response = $hashtagController->showHashtaglistDetails();
    echo $response;
}

function showHashtaglists() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $response = $hashtagController->showHashtaglists();
    echo $response;
}

/* Pruebas */
/*
function createSavedQuery() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $post_array = $app->request()->post();
    $hashtag = $post_array['query'];
    $response = $hashtagController->createSavedQuery($hashtag);
    echo $response;
}

function get_saved() {
    $hashtagController = new controllers\hashtagController();
    $app = \Slim\Slim::getInstance();
    $response = $hashtagController->get_saved();
    echo $response;
}
*/