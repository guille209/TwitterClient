<?php

namespace controllers;
use Abraham\TwitterOAuth\TwitterOAuth;
/**
 * Description of logInController
 *
 * @author Propietario
 * 
 */
class registerController implements interfaces\iRegisterController {

    function login() {
        if (!isset($_SESSION['access_token'])) {
            $connection = new TwitterOAuth(CONSUMER_KEY,CONSUMER_SECRET);
            $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
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
