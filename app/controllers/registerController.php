<?php

namespace controllers;
include $_SERVER['DOCUMENT_ROOT'] . '/controllers/interfaces/iRegisterController.php';

use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Description of logInController
 *
 * @author Propietario
 * 
 */
define('CONSUMER_KEY', 'js6Wzbj8LZbWImero7g2fmipb');
define('CONSUMER_SECRET', 'nYCQXKSWqnjkej6a9XxkckO1ZPLIY14Xu1RQnu7nVjoAoi9tDp');
define('OAUTH_CALLBACK', 'http://localhost:8080/home');

class registerController implements interfaces\iRegisterController {

    function login() {
        $_SESSION['CONSUMER_KEY'] = CONSUMER_KEY;
        $_SESSION['CONSUMER_SECRET'] = CONSUMER_SECRET;
        $_SESSION['OAUTH_CALLBACK'] = OAUTH_CALLBACK;
        if (!isset($_SESSION['access_token'])) {
            $connection = new TwitterOAuth($_SESSION['CONSUMER_KEY'], $_SESSION['CONSUMER_SECRET']);
            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $_SESSION['OAUTH_CALLBACK']));
            $_SESSION['oauth_token'] = $request_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
            $url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));
            return "<a href='" . $url . "'>Login With twitter</a>";
        } else {
            $app = \Slim\Slim::getInstance();
            $app->redirect('/home');
        }
    }

    function logout() {
        unset($_SESSION['access_token']);
        unset($_REQUEST['oauth_verifier']);
        unset($_SESSION['userLogged']);

        $app = \Slim\Slim::getInstance();
        $app->redirect('/login');
    }

}
