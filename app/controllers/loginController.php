<?php

namespace controllers;

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

class loginController {

    //put your code here


    function login() {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        $url = $connection->url('oauth/authenticate', array('oauth_token' => $request_token['oauth_token']));
        return "<a href='" . $url . "'>Login With twitter</a>";
    }

    function home() {
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
        $_SESSION['access_token'] = $access_token;
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
        $user = $connection->get("account/verify_credentials");
        var_dump($user);
    }

}
